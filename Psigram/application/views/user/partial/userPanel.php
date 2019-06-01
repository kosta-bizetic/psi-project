
<div class="container-fluid">
    <div class="row justify-content-center">
        <table style="cursor: pointer" onclick="location.href='<?php echo site_url("$this->class_name/profile/".$user->id_user)?>'" class="table table-hover col-md-4">
            <tbody>
              <tr class="table-primary">
                <td class="col-md-2"><strong>@<?php echo $user->username ?></strong></th>
                <td class="col-md-2"><?php echo $user->name.' '.$user->surname ?></td>
              </tr>
            </tbody>
        </table>
    </div>
</div>
