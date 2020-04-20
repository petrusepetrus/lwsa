<?php

namespace App\Http\Controllers;

use App\Swimmer;
use App\Contact;
use App\SwimClass;
use App\SwimClassSwimmer;
use App\SwimmerStatus;
use App\ContactRelationshipType;
use App\ContactContact;
use App\Http\Requests\SwimmerStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SwimmerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $swimmers = DB::table('swimmers')
            ->rightJoin('swimmer_statuses', 'swimmers.swimmer_status_id', '=', 'swimmer_statuses.id')
            ->leftJoin('contacts as swimmerContactDetails', 'swimmerContactDetails.id', '=', 'swimmers.contact_id')
            ->leftjoin('contact_contacts', 'child_contact_id', '=', 'swimmerContactDetails.id')
            ->leftjoin('contacts as parentContactDetails', 'parentContactDetails.id', '=', 'contact_contacts.parent_contact_id')
            ->leftjoin('contact_relationship_types', 'contact_relationship_types.id', '=', 'contact_contacts.parent_relationship_type_id')
            //->where('relationship_type', '=', 'parent')
            //->where('relationship_type', '=', 'parent')->orWhere(function ($q) {
            //    $q->where('contact_contacts.parent_relationship_type_id', '=', null);
           //})
            ->where('swimmer_status', '=', 'current')
            ->select(
                'swimmers.id as swimmer_id',
                'swimmer_status',
                'swimmers.adult_swimmer as swimmer_adult_swimmer',
                'swimmerContactDetails.id as swimmer_contact_id',
                'swimmerContactDetails.first_name as swimmer_first_name',
                'swimmerContactDetails.last_name as swimmer_last_name',
                'swimmerContactDetails.full_name as swimmer_full_name',
                'swimmerContactDetails.mobile as swimmer_mobile',
                'swimmerContactDetails.email as swimmer_email',
                'swimmerContactDetails.email as swimmer_sex',
                'swimmerContactDetails.date_of_birth as swimmer_date_of_birth',
                'parentContactDetails.id as parent_contact_id',
                'parentContactDetails.first_name as parent_first_name',
                'parentContactDetails.last_name as parent_last_name',
                'parentContactDetails.full_name as parent_full_name',
                'parentContactDetails.email as parent_email',
                'parentContactDetails.mobile as parent_mobile')
            ->orderBy('swimmers.id', 'asc')
            ->paginate(15);

        //$swimmers = Swimmer::with('swimmerContact', 'swimClass', 'swimmerStatus', 'swimmerContact.parentContacts')
        //    ->orderBy('swimmers.id', 'asc')
        //    ->paginate(15);
        //dd($swimmers);
        return view('swimmers\index', compact('swimmers'));

    }

    public function search(Request $request)
    {

        if ($request->ajax()) {
            $output = "";
            $swimmers = DB::table('swimmers')
                ->rightJoin('swimmer_statuses', 'swimmers.swimmer_status_id', '=', 'swimmer_statuses.id')
                ->leftJoin('contacts as swimmerContactDetails', 'swimmerContactDetails.id', '=', 'swimmers.contact_id')
                ->leftjoin('contact_contacts', 'child_contact_id', '=', 'swimmerContactDetails.id')
                ->leftjoin('contacts as parentContactDetails', 'parentContactDetails.id', '=', 'contact_contacts.parent_contact_id')
                ->leftjoin('contact_relationship_types', 'contact_relationship_types.id', '=', 'contact_contacts.parent_relationship_type_id')
                ->where('swimmerContactDetails.full_name', 'LIKE', '%' . $request->search . '%')
                //->where('relationship_type', '=', 'parent')
                //->orWhere(function ($q) {
                //    $q->where('contact_contacts.parent_relationship_type_id', '=', null);
                //})
                ->where('swimmer_status', '=', 'current')
                ->select(
                    'swimmers.id as swimmer_id',
                    'swimmers.adult_swimmer as swimmer_adult_swimmer',
                    'swimmerContactDetails.id as swimmer_contact_id',
                    'swimmerContactDetails.first_name as swimmer_first_name',
                    'swimmerContactDetails.last_name as swimmer_last_name',
                    'swimmerContactDetails.full_name as swimmer_full_name',
                    'swimmerContactDetails.mobile as swimmer_mobile',
                    'swimmerContactDetails.email as swimmer_email',
                    'swimmerContactDetails.email as swimmer_sex',
                    'swimmerContactDetails.date_of_birth as swimmer_date_of_birth',
                    'parentContactDetails.id as parent_contact_id',
                    'parentContactDetails.first_name as parent_first_name',
                    'parentContactDetails.last_name as parent_last_name',
                    'parentContactDetails.full_name as parent_full_name',
                    'parentContactDetails.email as parent_email',
                    'parentContactDetails.mobile as parent_mobile')
                ->orderBy('swimmers.id', 'asc')
                ->paginate(15);
            //dd($swimmers);


            foreach ($swimmers as  $key=>$swimmer) {


                $output .=
                    '<tr>' .
                    '<td>' . $swimmer->swimmer_id . '</td >' .
                    '<td>' . $swimmer->swimmer_contact_id . '</td >' .
                    '<td>' . $swimmer->swimmer_full_name . '</td >';



                if (!$swimmer->swimmer_adult_swimmer) {

                    $output .=



                        '<td>' . $swimmer->parent_email . '</td >' .
                        '<td>' . $swimmer->parent_mobile . '</td >'.
                    '<td>' . $swimmer->parent_full_name . '</td >' ;
                } else {

                    $output .=

                        '<td>' . $swimmer->swimmer_email . '</td >' .
                        '<td>' . $swimmer->swimmer_mobile . '</td >' .
                        '<td></td>';
                }
                $output .= '<td><a class="btn btn-primary btn-sm" href="/swimmers/' . $swimmer->swimmer_id . '"><span
                                                class="fas fa-search" aria-hidden="true"></span></a></td>';
                $output .= '<td><a class="btn btn-success btn-sm"
                                       href="/swimmers/' . $swimmer->swimmer_id . '/edit/"><span
                                                class="fas fa-edit" aria-hidden="true"></span></a></td>';
                $output .= '<td><a class="btn btn-danger btn-sm"
                                       href="/swimmers/' . $swimmer->swimmer_id . '/delete/"><span
                                                class="fas fa-trash" aria-hidden="true"></span></a></td>';
                $output .= "</tr>";

            }

            return Response($output);

            //return view('swimmers\index', compact('swimmers'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('swimmers\create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SwimmerStoreRequest $request)
    {
        //request()->validate([
        //    'first-name' => 'required',
        //    'last-name' => 'required',
        //    'date-of-birth' => 'required|date_format:Y-m-d|before:today',
        //    'gender' => 'required|in:F,M',
        //    'email' => 'required_if:adult-swimmer,1|nullable|email:rfc',
        //    'mobile-phone'=>'required_if:adult-swimmer,1|nullable|max:11|phone:GB,mobile',
        //]);


        $contact=new contact();
        $contact->first_name=request('first-name');
        $contact->last_name=request('last-name');
        $contact->full_name=request('first-name').' '.request('last-name');
        $contact->date_of_birth=request('date-of-birth');
        $contact->sex=request('gender');
        $contact->email=request('email');
        $contact->mobile=request('mobile-phone');
        $contact->save();

        $isChecked = $request->has('adult-swimmer');
        $status=SwimmerStatus::SwimmerStatus("Current")->get();
        $status_id=$status->pluck('id')->first();
        $swimmer=new swimmer();
        $swimmer->adult_swimmer=$isChecked;
        $swimmer->contact_id=$contact->id;
        $swimmer->swimmer_status_id=$status_id;
        $swimmer->save();



        return redirect('\swimmers');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Swimmer $contact
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd($id);
        $swimmers = Swimmer::where('swimmers.id', '=', $id)->with('swimmerContact', 'swimClass', 'swimmerStatus', 'swimmerContact.parentContacts')
            ->get();

        //foreach ($contacts as $contact) {
        //    $contactContacts = $contact->swimmerContact;
        //    foreach ($contactContacts->parentContacts as $contactParent) {
        //        $parentRelationshipType = ContactRelationshipType::where('id', $contactParent->pivot->parent_relationship_type_id)->get();
        //        //dd($parentRelationshipType);
        //    }
        //}
        return view('swimmers\show', compact('swimmers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Swimmer $contact
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $swimmers = Swimmer::where('swimmers.id', '=', $id)->with('swimmerContact', 'swimClass', 'swimmerStatus', 'swimmerContact.parentContacts')
            ->get();
        //dd($swimmers);
        //foreach ($contacts as $contact) {
        //    $contactContacts = $contact->swimmerContact;
        //    foreach ($contactContacts->parentContacts as $contactParent) {
        //        $parentRelationshipType = ContactRelationshipType::where('id', $contactParent->pivot->parent_relationship_type_id)->get();
        //        //dd($parentRelationshipType);
        //    }
        //}

        return view('swimmers\edit', compact('swimmers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Swimmer $contact
     * @return \Illuminate\Http\Response
     */
    public function update(SwimmerStoreRequest $request, $id)
    {

        //request()->validate([
        //    'first-name' => 'required',
        //    'last-name' => 'required',
        //    'date-of-birth' => 'nullable|date_format:Y-m-d|before:today',
        //    'gender' => 'required|in:F,M',
        //    'email' => 'required_if:adult-swimmer,1|nullable|email:rfc',
        //    'mobile-phone'=>'required_if:adult-swimmer,1|nullable|max:11|phone:GB,mobile',
        //]);
//dd($request);
        $isChecked = $request->has('adult-swimmer');
        $swimmer=Swimmer::find($id);
        $swimmer->adult_swimmer=$isChecked;
        $swimmer->update();

        $contact_id=$swimmer->contact_id;
        //dd($contact_id);

        $contact=Contact::find($contact_id);
        $contact->first_name=request('first-name');
        $contact->last_name=request('last-name');
        $contact->full_name=request('first-name').' '.request('last-name');
        $contact->date_of_birth=request('date-of-birth');
        $contact->sex=request('gender');
        $contact->email=request('email');
        $contact->mobile=request('mobile-phone');
//dd($contact);
        $contact->update();


        return redirect('/swimmers/' . $id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Swimmer $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Swimmer $contact)
    {
        echo("Delete");
    }
}
