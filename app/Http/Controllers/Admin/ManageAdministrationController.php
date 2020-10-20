<?php

namespace App\Http\Controllers\Admin;



use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ManageAdministrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.manageadministration.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getdata()
    {
        // $employee = Employee::all();
        //  DB::enableQueryLog(); // Enable query log
        $submission = DB::select(
            'SELECT
                        b.`id`,
                        a.`no_reg`,
                        a.`first_name`,
                        a.`last_name`,
                        b.`id_activity`,
                        b.`status_of_document`,
                        b.`status_of_administration`,
                        b.`status_of_exit_interview`,
                        b.`status_of_submission`
                        FROM `employee` A
                        INNER JOIN `submission` B ON a.`id` = b.`id_employee`
                        WHERE b.`status_of_submission`=:status_of_submission
                        AND b.`status_of_document` != 1 
                        AND b.`status_of_administration` != 1',
            ['status_of_submission' => 4]
        );
        //  dd(DB::getQueryLog()); // Show results of log

        return Datatables::of($submission)
            ->addColumn('type_submission',  function ($submission) {

                if ($submission->id_activity == 1)
                    $action = 'Resign';
                elseif ($submission->id_activity == 2)
                    $action = 'Pensiun';
                else
                    $action = 'Ended Contract';

                return $action;
            })
            ->addColumn('document',  function ($submission) {

                if ($submission->status_of_document == 0 || empty($submission->status_of_document))
                    $action = '<span class="btn btn-xs btn-danger">Not Yet</span>';
                else
                    $action = '<span class="btn btn-xs btn-success">Done</span>';

                return $action;
            })
            ->addColumn('administration',  function ($submission) {
                if ($submission->status_of_administration == 0 || empty($submission->status_of_administration))
                    $action = '<span class="btn btn-xs btn-danger">Not Yet</span>';
                else
                    $action = '<span class="btn btn-xs btn-success">Done</span>';
                return $action;
            })
            ->addColumn('full_name',  function ($submission) {
                $action = $submission->first_name . " " . $submission->last_name;
                return $action;
            })
            ->addColumn('submission',  function ($submission) {
                if ($submission->status_of_submission == 4)
                    $action = '<span class="btn btn-xs btn-success">Approved</span>';

                return $action;
            })
            ->addColumn('generate_document',  function ($submission) {

                $action = '<div class="btn-group">
                    <a href="manageadministration/' . $submission->id . '/download" title="Download File" class="btn btn-xs btn-default"><i class="fa fa-file"></i> Generate Document
                    </a>
                </div>';
                return $action;
            })
            ->rawColumns(['type_submission', 'document', 'administration', 'full_name', 'submission', 'generate_document'])
            ->make(true);
    }

    public function download($id)
    {
        # code...
        $time = time();
        $employee = DB::table("employee")
            ->join('submission', 'employee.id', "=", "submission.id_employee")
            ->join('division', 'employee.division_id', "=", "division.id")
            ->join('department', 'employee.department_id', "=", "department.id")
            ->join('section', 'employee.section_id', "=", "section.id")
            ->join('position', 'employee.position_id', "=", "position.id")
            ->select('employee.*', 'submission.date_of_submission', 'submission.date_of_ended_work', 'submission.id_activity', 'division.name AS division_name', 'department.name AS department_name', 'section.name AS section_name', 'position.name AS position_name')
            ->where('submission.id', $id)
            ->first();


        $template_file = "upload/template/";
        // dd($template);
        $pathFile = 'upload/file/' . $time . "/";
        if (!is_dir($pathFile)) {
            mkdir($pathFile);
        }

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($template_file . "surat_keterangan_bekerja.docx");


        $templateProcessor->setValue('nomor_surat', time());
        $templateProcessor->setValue('bulan', $this->getRomawi(date("m")));
        $templateProcessor->setValue('tahun', date("Y"));

        $templateProcessor->setValue('full_name', $employee->first_name . " " . $employee->last_name);
        $templateProcessor->setValue('no_reg', $employee->no_reg);
        $templateProcessor->setValue('jabatan', $employee->position_name);
        $templateProcessor->setValue('section_name', $employee->section_name);
        $templateProcessor->setValue('department_name', $employee->department_name);
        $templateProcessor->setValue('division_name', $employee->division_name);

        $templateProcessor->setValue('entry_date', Carbon::parse($employee->date_of_entry)->format('d F Y'));
        $templateProcessor->setValue('end_date', Carbon::parse($employee->date_of_ended_work)->format('d F Y'));

        $fileNameKet = $employee->no_reg . '_surat_keterangan_bekerja_' . time() . '.docx';

        $templateProcessor->saveAs($pathFile . $fileNameKet);

        // $headers = ['Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        // $newName = $employee->no_reg . '_surat_keterangan_bekerja_' . time() . '.docx';

        $head_of_division = DB::table("employee")
            ->join('division', 'employee.division_id', "=", "division.id")
            ->select('employee.*', 'division.name')
            ->where('division_id', $employee->division_id)
            ->where('position_id', 7)->first();

        $head_of_division_HRGA = DB::table("employee")
            ->join('division', 'employee.division_id', "=", "division.id")
            ->select('employee.*', 'division.name')
            ->where('division_id', 13)
            ->where('position_id', 7)->first();


        if ($employee->id_activity == 1) {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($template_file . "surat_undangan_resign.docx");


            $templateProcessor->setValue('nomor_surat', time());
            $templateProcessor->setValue('bulan', $this->getRomawi(date("m")));
            $templateProcessor->setValue('tahun', date("Y"));
            $templateProcessor->setValue('current_date', date("d F Y"));

            $templateProcessor->setValue('employee_name', $employee->first_name . " " . $employee->last_name);
            $templateProcessor->setValue('division_name', $employee->division_name);
            $templateProcessor->setValue('submission_date', Carbon::parse($employee->date_of_submission)->format('d F Y'));
            $templateProcessor->setValue('day', $this->getDayOfIndo(Carbon::parse($employee->date_of_ended_work)->format('D')));
            $templateProcessor->setValue('end_date', Carbon::parse($employee->date_of_ended_work)->format('d F Y'));
            // $templateProcessor->setValue('time', "10.00");

            $templateProcessor->setValue('name', $head_of_division_HRGA->first_name . " " . $head_of_division_HRGA->last_name);


            $fileNameRes = $employee->no_reg . '_surat_undangan_resign_' . time() . '.docx';
            $templateProcessor->saveAs($pathFile . $fileNameRes);

            $headers = ["Content-Type" => "application/zip"];
            $fileName = $employee->no_reg . ".zip"; // name of zip
            $zipper = new \Madnest\Madzipper\Madzipper;
            $zipper->make(public_path($pathFile . $fileName)) //file path for zip file
                ->add(public_path($pathFile) )->close(); //files to be zipped


            DB::table('submission')
                ->where('id', $id)
                ->update(['status_of_document' => 1, 'result_all_file' => $pathFile . $fileName]);

            return response()->download(public_path($pathFile . $fileName), $fileName, $headers);
        }

        else if ($employee->id_activity == 2) {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($template_file . "surat_undangan_pensiun.docx");


            $templateProcessor->setValue('nomor_surat', time());
            $templateProcessor->setValue('bulan', $this->getRomawi(date("m")));
            $templateProcessor->setValue('tahun', date("Y"));
            $templateProcessor->setValue('current_date', date("d F Y"));

            $templateProcessor->setValue('employee_name', $employee->first_name . " " . $employee->last_name);
            $templateProcessor->setValue('division_name', $employee->division_name);
            $templateProcessor->setValue('submission_date', Carbon::parse($employee->date_of_submission)->format('d F Y'));
            $templateProcessor->setValue('day', $this->getDayOfIndo(Carbon::parse($employee->date_of_ended_work)->format('D')));
            $templateProcessor->setValue('end_date', Carbon::parse($employee->date_of_ended_work)->format('d F Y'));
            // $templateProcessor->setValue('time', "10.00");

            $templateProcessor->setValue('name', $head_of_division_HRGA->first_name . " " . $head_of_division_HRGA->last_name);


            $fileNameRes = $employee->no_reg . '_surat_undangan_pensiun_' . time() . '.docx';
            $templateProcessor->saveAs($pathFile . $fileNameRes);

            $headers = ["Content-Type" => "application/zip"];
            $fileName = $employee->no_reg . ".zip"; // name of zip
            $zipper = new \Madnest\Madzipper\Madzipper;
            $zipper->make(public_path($pathFile . $fileName)) //file path for zip file
                ->add(public_path($pathFile))->close(); //files to be zipped


            DB::table('submission')
                ->where('id', $id)
                ->update(['status_of_document' => 1, 'result_all_file' => $pathFile . $fileName]);

            return response()->download(public_path($pathFile . $fileName), $fileName, $headers);
        } 
        else if ($employee->id_activity == 3) {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($template_file . "surat_undangan_ended.docx");


            $templateProcessor->setValue('nomor_surat', time());
            $templateProcessor->setValue('bulan', $this->getRomawi(date("m")));
            $templateProcessor->setValue('tahun', date("Y"));
            $templateProcessor->setValue('current_date', date("d F Y"));

            $templateProcessor->setValue('employee_name', $employee->first_name . " " . $employee->last_name);
            $templateProcessor->setValue('division_name', $employee->division_name);
            $templateProcessor->setValue('submission_date', Carbon::parse($employee->date_of_submission)->format('d F Y'));
            $templateProcessor->setValue('day', $this->getDayOfIndo(Carbon::parse($employee->date_of_ended_work)->format('D')));
            $templateProcessor->setValue('end_date', Carbon::parse($employee->date_of_ended_work)->format('d F Y'));
            // $templateProcessor->setValue('time', "10.00");

            $templateProcessor->setValue('name', $head_of_division_HRGA->first_name . " " . $head_of_division_HRGA->last_name);


            $fileNameRes = $employee->no_reg . '_surat_undangan_ended_' . time() . '.docx';
            $templateProcessor->saveAs($pathFile . $fileNameRes);

            $headers = ["Content-Type" => "application/zip"];
            $fileName = $employee->no_reg . ".zip"; // name of zip
            $zipper = new \Madnest\Madzipper\Madzipper;
            $zipper->make(public_path($pathFile . $fileName)) //file path for zip file
                ->add(public_path($pathFile))->close(); //files to be zipped

            DB::table('submission')
                ->where('id', $id)
                ->update(['status_of_document' => 1, 'result_all_file' => $pathFile . $fileName]);

            return response()->download(public_path($pathFile . $fileName), $fileName, $headers);
        }
    }

    private function getRomawi($bln)
    {
        switch ($bln) {
            case 1:
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
            case 4:
                return "IV";
                break;
            case 5:
                return "V";
                break;
            case 6:
                return "VI";
                break;
            case 7:
                return "VII";
                break;
            case 8:
                return "VIII";
                break;
            case 9:
                return "IX";
                break;
            case 10:
                return "X";
                break;
            case 11:
                return "XI";
                break;
            case 12:
                return "XII";
                break;
        }
    }

    private function getDayOfIndo($hari)
    {
        switch ($hari) {
            case 'Sun':
                $hari_ini = "Minggu";
                break;

            case 'Mon':
                $hari_ini = "Senin";
                break;

            case 'Tue':
                $hari_ini = "Selasa";
                break;

            case 'Wed':
                $hari_ini = "Rabu";
                break;

            case 'Thu':
                $hari_ini = "Kamis";
                break;

            case 'Fri':
                $hari_ini = "Jumat";
                break;

            case 'Sat':
                $hari_ini = "Sabtu";
                break;
        }

        return $hari_ini;
    }
}
