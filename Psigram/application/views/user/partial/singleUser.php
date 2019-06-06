<?php
/**
 * @author Luka Dojcilovic 2016/0135
 * @author Kosta Bizetic 2016/0121
 */
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <table onclick="location.href='<?php echo site_url("$this->class_name/profile/".$user->id_user)?>'" class="col-md-4">
            <tbody>
                <tr>
                <td class="col-md-2 leftTD" style="color: rgb(0, 123, 255);"><strong>@<?php echo $user->username ?></strong></th>
                <td class="col-md-2 rightTD" style="color: rgb(0, 123, 255);"><?php echo $user->name.' '.$user->surname ?></td>
              </tr>
            </tbody>
        </table>
    </div>
</div>
