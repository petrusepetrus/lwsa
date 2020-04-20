foreach ($swimmers as  $key=>$swimmer) {


<tr> 
    <td>  $swimmer->swimmer_id  </td > 
    <td>  $swimmer->swimmer_contact_id  </td > 
    <td>  $swimmer->swimmer_full_name  </td >



    if (!$swimmer->swimmer_adult_swimmer) {


    <td>  $swimmer->parent_email  </td > 
    <td>  $swimmer->parent_mobile  </td >
    <td>  $swimmer->parent_full_name  </td > 
    } else {

    $output =

    <td>  $swimmer->swimmer_email  </td > 
    <td>  $swimmer->swimmer_mobile  </td > 
    <td></td>
    };
   <td><a class="btn btn-primary btn-sm" href="/swimmers/  $swimmer->swimmer_id  "><span
                    class="fas fa-search" aria-hidden="true"></span></a></td>
    <td><a class="btn btn-success btn-sm"
                       href="/swimmers/  $swimmer->swimmer_id  /edit/"><span
                    class="fas fa-edit" aria-hidden="true"></span></a></td>
    <td><a class="btn btn-danger btn-sm"
                       href="/swimmers/  $swimmer->swimmer_id  /delete/"><span
                    class="fas fa-trash" aria-hidden="true"></span></a></td>
    </tr>

}