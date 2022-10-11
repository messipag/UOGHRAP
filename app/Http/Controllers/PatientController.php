<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Result;
use App\Models\Test;
use App\Models\Interpretation;
use App\Models\LabCategory;
use App\Models\ReferenceRange;
use App\Models\Machine;
use Illuminate\Http\Request;
use DB;
use PDF;
class PatientController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patient = Patient::latest()->get(); 
        return view('Lab_Result.index', compact('patient')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $machine = Machine::latest()->get(); 
        $labCtegory =LabCategory:: latest()->get(); 
        return view('Lab_Result.create', compact('machine','labCtegory'));
    } 
    public function addResult($id){
        $p_id = $id; 
        $machine = Machine::latest()->get(); 
        $labCtegory =LabCategory:: latest()->get(); 
        return view('Lab_Result.add_result', compact('machine','labCtegory','p_id'));
     }  
    public function formprocess(Request $request){
        //dd($request->all());
        $this->validate($request, [
            //'mac_id' => 'required',
            'cat_id' => 'required',
        ]);
        $p_id = trim($request->get('p_id'));
        
        if($request->get('mac_id') != null)
        {

            $mac_id = trim($request->get('mac_id'));
            $cat_id = trim($request->get('cat_id')); 
            $machine = Machine::latest()->get(); 
            $labCtegory = LabCategory:: latest()->get();  
            $ctegory = LabCategory::where('lab_categories.id', '=', $cat_id)->first(); 
            // $interpretation = Interpretation::where('interpretations.cat_id', '=', $cat_id)->get(); 
            $machineCode = Machine::where('machines.id', '=', $mac_id)->first(); 
             
             $formProcess = DB::table('reference_ranges')
                            ->join('lab_categories','lab_categories.id', '=', 'reference_ranges.cat_id')
                             ->join('tests','tests.id', '=', 'reference_ranges.tes_id') 
                            ->where('reference_ranges.cat_id', '=', $cat_id)
                             ->where('reference_ranges.mac_id', '=', $mac_id)
                            ->select('reference_ranges.*','tests.tes_name AS t_name','tests.id AS t_id','lab_categories.*')
                            ->get();  

            if($request->get('p_id') != null){
                //dd('i am ok');
                $patient = Patient::where('patients.id', '=', $p_id)->first(); 
               // dd($patient);
                return view('Lab_Result.add_result',compact('formProcess','machine','labCtegory','ctegory','machineCode','p_id','patient'));
            }
            else{
                return view('Lab_Result.create',compact('formProcess','machine','labCtegory','ctegory','machineCode'));
            }
            
        }
        else{
           
            $cat_id = trim($request->get('cat_id'));
            $refrenceRange = ReferenceRange::where('reference_ranges.cat_id', '=', $cat_id)->first(); 

            if($refrenceRange != null)
            {
                toastr()->warning('Test category allready have it own machine and ref_range please select the machine', 'Warning!');
               
                return redirect()->route('patients.create');
            }

            else
            {
               
                $machine = Machine::latest()->get(); 
                $labCtegory =LabCategory:: latest()->get();  
                $ctegory =LabCategory::where('lab_categories.id', '=', $cat_id)->first(); 
                // $interpretation = Interpretation::where('interpretations.cat_id', '=', $cat_id)->get(); 
        
                $formProcess = DB::table('tests')
                                ->join('lab_categories','lab_categories.id', '=', 'tests.cat_id')
                                //->join('tests','tests.id', '=', 'reference_ranges.tes_id')
                                ->where('tests.cat_id', '=', $cat_id)
                                //->where('reference_ranges.mac_id', '=', $mac_id)
                                ->select('tests.tes_name AS t_name','tests.id AS t_id','lab_categories.cat_name','lab_categories.id As c_id')
                                ->get(); 

                if($request->get('p_id') != null){
                    $patient = Patient::where('patients.id', '=', $p_id)->first(); 
                    return view('Lab_Result.add_result',compact('formProcess','machine','labCtegory','ctegory','p_id','patient'));
                }
                else{
                    return view('Lab_Result.create',compact('formProcess','machine','labCtegory','ctegory'));
                } 
            }  
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        //dd($request->all());
        if($request->get('p_id') == null){
            
            $this->validate($request, [
                'full_name' => 'required',
                'age' => 'required',    
                'sex' => 'required'
            ]);
   // dd($request->all());
            $patient = Patient::create([
                'full_name' => $request->full_name,
                'age' => $request->age,
                'sex' => $request->sex,
                'phone_num' => $request->phone_num,
                'MRN' => $request->MRN,
                'LSN' => $request->LSN, 
                'create_by' => auth()->user()->email,
                'update_by' => auth()->user()->email,
            ]);
            $input = $request->all();
    
            if($request->mac_id == null){
                for($i=0; $i<= count($input['result']); $i++)
                {
        
                    if(empty($input['result'][$i])) continue;
        
                    $result = [  
                    'pat_id' => $patient->id,
                    'cat_id' => $input['cat_id'][$i],
                    'tes_id' => $input['tes_id'][$i],
                    'type'   => $input['type'],
                    'result' => $input['result'][$i],
                    'remark' => $input['remark'][$i], 
                    'create_by' => auth()->user()->email,
                    'update_by' => auth()->user()->email, 
                    ];
        
                    Result::create($result); 
                   }
            }
    
            else{
                for($i=0; $i<= count($input['result']); $i++)
                {
    
                    if(empty($input['result'][$i])) continue;
    
                    $result = [  
                    'pat_id' => $patient->id,
                    'cat_id' => $input['cat_id'][$i],
                    'mac_id' => $input['mac_id'][$i],
                    'tes_id' => $input['tes_id'][$i], 
                    'type'   => $input['type'],
                    'result' => $input['result'][$i],
                    'remark' => $input['remark'][$i], 
                    'create_by' => auth()->user()->email,
                    'update_by' => auth()->user()->email, 
                    ];
                    Result::create($result); 
               }
            }
        }
        else{
            $input = $request->all();
    
            if($request->mac_id == null){
                for($i=0; $i<= count($input['result']); $i++)
                {
        
                    if(empty($input['result'][$i])) continue;
        
                    $result = [  
                    'pat_id' => $request->p_id,
                    'cat_id' => $input['cat_id'][$i],
                    'tes_id' => $input['tes_id'][$i], 
                    'type'   => $input['type'],
                    'result' => $input['result'][$i],
                    'remark' => $input['remark'][$i], 
                    'create_by' => auth()->user()->email,
                    'update_by' => auth()->user()->email, 
                    ];
        
                    Result::create($result); 
                   }
            }
    
            else{
                for($i=0; $i<= count($input['result']); $i++)
                {
    
                    if(empty($input['result'][$i])) continue;
    
                    $result = [  
                    'pat_id' => $request->p_id,
                    'cat_id' => $input['cat_id'][$i],
                    'mac_id' => $input['mac_id'][$i],
                    'tes_id' => $input['tes_id'][$i],
                    'type'   => $input['type'],
                    'result' => $input['result'][$i],
                    'remark' => $input['remark'][$i], 
                    'create_by' => auth()->user()->email,
                    'update_by' => auth()->user()->email, 
                    ];
                    Result::create($result); 
               }
            }
        }


        return redirect()->route('patients.index') ; 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    { 
        $cat = DB::table('results') 
                ->join('lab_categories','lab_categories.id','=','results.cat_id')
                ->leftJoin('machines','machines.id', '=', 'results.mac_id')
                ->select('lab_categories.cat_name','machines.mac_name','results.type')
                ->where('results.pat_id', '=', $patient->id)
                ->groupBy('lab_categories.cat_name','machines.mac_name')
                ->get();    
        $results = DB::table('results')   
                    ->join('tests','tests.id', '=', 'results.tes_id') 
                    ->join('lab_categories','lab_categories.id','=','results.cat_id')
                    ->leftJoin('machines','machines.id', '=', 'results.mac_id')
                    ->leftJoin('reference_ranges','reference_ranges.tes_id', '=', 'results.tes_id')
                    ->select('tests.tes_name','lab_categories.cat_name','results.result','reference_ranges.ref_renge','reference_ranges.unit','results.Remark','machines.mac_name')
                    ->where('results.pat_id', '=', $patient->id)
                    //->groupBy('lab_categories.cat_name')
                    ->get();  
        //dd($results);
        return view('Lab_Result.show', compact('patient','results','cat'));
    }
    public function generatePDF($id)
    { 
        //get patient detail 
        $patient = Patient::where('patients.id', '=', $id)->first(); 
        //end patient detail

        if($patient->count() > 0){

            $cat = DB::table('results') 
                    ->join('lab_categories','lab_categories.id','=','results.cat_id')
                    ->leftJoin('machines','machines.id', '=', 'results.mac_id')
                    ->select('lab_categories.cat_name','lab_categories.id as cat_id','machines.mac_name','results.type')
                    ->where('results.pat_id', '=', $patient->id)
                    ->groupBy('lab_categories.cat_name','machines.mac_name')
                    ->get(); 
            $cat_id = $cat[0]->cat_id;
            $interpretation = Interpretation::where('interpretations.cat_id', '=', $cat_id)->get(); 
            //dd($interpretation);
            $results = DB::table('results')   
                        ->join('tests','tests.id', '=', 'results.tes_id') 
                        ->join('lab_categories','lab_categories.id','=','results.cat_id')
                        ->leftJoin('machines','machines.id', '=', 'results.mac_id')
                        ->leftJoin('reference_ranges','reference_ranges.tes_id', '=', 'results.tes_id')
                        ->select('tests.tes_name','lab_categories.cat_name','results.result','reference_ranges.ref_renge','reference_ranges.unit','results.Remark','machines.mac_name')
                        ->where('results.pat_id', '=', $patient->id)
                        //->groupBy('lab_categories.cat_name')
                        ->get(); 

            $pdf = PDF::loadView('report.labResultPDF', compact('patient','results','cat','interpretation'));
            return $pdf->stream(); 
        }
        else{
            toastr()->warning('We can not find the result for your request .', 'error message!');
            return redirect()->route('patients.index');
        }
 
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {  
        return view('Lab_Result.edit', compact('patient')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $request->validate([ 
            'full_name' => 'required|max:255',
            'age' => 'required',    
            'sex' => 'required',
            ]);

        $input = $request->all();    
        $input['update_by'] = auth()->user()->email;

        $patient->update($input);   

        toastr()->success('Patient Information Successfully Updated .', 'Patient Info Updated!');
        return redirect()->route('patients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        toastr()->success('Patient information Successfully Deleted .', 'Patient Deleted!');
        return redirect()->route('patients.index');
    }
}
