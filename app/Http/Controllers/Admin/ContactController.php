<?php

namespace App\Http\Controllers\Admin;

use App\Model\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
  public function addContactInfo(Request $request){
    if ($request->isMethod('post')) {
      $contact = new Contact;
      $contact->office_name = $request->office_name;
      $contact->address = $request->address;
      $contact->mobile = $request->mobile;
      $contact->hotline = $request->hotline;
      $contact->phone = $request->phone;
      $contact->email = $request->email;
      $contact->skype = $request->skype;
      $contact->map_url = $request->map_url;
      $contact->save();
      return redirect('/admin/view_contact_info')->with('success_message', 'Data Added Successfully !!');
    }
    return view('admin.contact.add_contact_info');
  }


  public function viewContactInfo(){
    $contacts = Contact::get();
    return view('admin.contact.view_contact_info')->with(compact('contacts'));
  }


  public function editContactInfo(Request $request, $id){
    if ($request->isMethod('post')) {
      $contact = Contact::find($id);
      $contact->office_name = $request->office_name;
      $contact->address = $request->address;
      $contact->mobile = $request->mobile;
      $contact->hotline = $request->hotline;
      $contact->phone = $request->phone;
      $contact->email = $request->email;
      $contact->skype = $request->skype;
      $contact->map_url = $request->map_url;
      $contact->save();
      return redirect('/admin/view_contact_info')->with('success_message', 'Data Updated Successfully !!');
    }
    $contact = Contact::find($id);
    return view('admin.contact.edit_contact_info')->with(compact('contact'));
  }


  public function deleteContactInfo($id){
    $contact = Contact::find($id);
    $contact->delete();
    return redirect('/admin/view_contact_info')->with('success_message', 'Data Deleted Successfully !!');
  }
}
