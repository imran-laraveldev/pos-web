<form id="marksheetForm" method="post" >
    <div class="form-body">
        <div class="row alert alert-success">
            <div class="col-md-6  col-sm-12">
                <label class="control-label col-md-3 col-sm-4">{{ __('Course Name').' / '.('Section') }}</label>
                <?php
                $subject_id = $_POST['subject_id'] ?? '';
                $c = isset($_POST['course_id']) ? $_POST['course_id'] : '';
                $sec = isset($_POST['section']) ? $_POST['section'] : 'A';
                $admin_user = ('role_id' == 1) ? true : false;
                ?>
                <div class="col-md-7 col-sm-7">
                    <div class="form-group">
                        <?php
                        if (true) {
                            echo '<select name="course_id" class="form-control col-md-6  col-sm-6" id="course_id" style="width: 150px" onchange="marksheetForm.submit();" >';
                            foreach($course_list as $course){
                                $course_id = $course->course_id;
                                $sel = ($course_id ==  $c) ?  'selected' : '' ;
                                echo '<option value="'.$course_id.'" '.$sel.'>'.$course->course_name.'</option>';
                            }
                            echo '</select>';
                            echo '<input type="text" name="section" class="form-control col-md-4  col-sm-4" id="section" value="'.$sec.'" style="width: 50px">';
                        }else{
                        foreach($course_list as $course){
                            $course_id = $course->course_id;
                            if($course_id ==  $c) { $course_name = $course->course_name; break;}
                        }
                        ?>
                        <input type="hidden" name="course_id" id="course_id" value="<?php echo $c; ?>">
                        <input type="text" name="course_name" readonly="readonly" class="form-control col-md-6" id="course_name" value="<?php echo $course_name; ?>" style="width: 150px">
                        <input type="text" name="section" readonly="readonly" class="form-control col-md-4" id="section" value="<?php echo $sec; ?>" style="width: 50px">
                        <?php }	?>
                    </div>
                </div>
            </div>
            <div class="col-md-6  col-sm-12">
                <div class="form-group">
                    <div class="col-md-4 col-sm-4" >
                        <?php $term_name = 'First';?>
                        <select name="term" class="form-control" id="term" style="width: 170px" onchange="marksheetForm.submit();">
                            <?php
                            $arr_m = array('--','January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
                            for($m = 1; $m <= 20; $m++){
                                $selected =  ($term == $m) ? 'selected' : '';
                                echo '<option value="'.$m.'"  '.$selected.' > Test '.$m.' </option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-4" >
                    <!-- <input type="text" name="subject" class="form-control" id="subject" value="<?php //echo $subject; ?>"> -->
                        <select name="subject_id" class="form-control" id="subject_id" onchange="marksheetForm.submit();">
                            <?php foreach($subject_list as $sub){
                            $sid = $sub->subject_id;
                            $sel = ($subject_id == $sid) ? 'selected' : '';
                            ?>
                            <option value=<?php echo '"'.$sid.'" '.$sel;?> ><?php echo $sub->subject_name;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-2  col-sm-2" >
                        <?php //$subject_id = isset($_POST['subject_id']) ? $_POST['subject_id']: 1;
                        $term_id = isset($_POST['term']) ? $_POST['term']: 1;?>
                        <a class="btn green" href="<?php echo $model.'/print_view/?course_id='.$c."&section=".$sec."&term=". $term."&subject_id=".$subject_id;?>" target="_blank"><i class="fa fa-print"></i> Print</a>

                    </div>
                    <div class="col-md-1  col-sm-1" >
                        <a class="btn blue" href="<?php echo $model.'/attendance_list/?course_id='.$c."&section=".$sec."&term=". $term."&subject_id=".$subject_id;?>" target="_blank"><i class="fa fa-list"></i></a>
                    </div>
                    <div class="col-md-1  col-sm-1" >
                        <?php
                        $title = "Update Subject Marks";
                        $param = "course_id=".$c."&section=".$sec."&t=".$term;
                        $url   =  $model."/update_marks";
                        ?>
                        <a <?php echo 'onclick="showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'}, \'tbl_marksheet\')"';?> href="#" class="btn blue" ><i class="fa fa-edit"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-6" >
                <div class="padding-5">
                    <a class="btn red" href="<?php echo $model.'/send_sms/?course_id='.$c."&section=".$sec."&term=". $term."&subject_id=".$subject_id;?>" target="_blank"><i class="fa fa-envalope"></i> SEND SMS </a>

                    <?php echo 'Total Marks: '.$subject_total.', Sent on: '.$sent_on; ?>
                    <a class="" href="<?php echo $model.'/student_count_per_subject';?>" target="_self"><i class="fa fa-envalope"></i> COUNT </a>
                </div>
            </div>
        </div>

        <div class="row alert alert-info cl-md-12" id="tbl_marksheet" >
            <table border="1" style="border: 2px solid #000; width: 100%; background-color: #FFF; color: #000;">

                <tr style="border-bottom: 2px solid #000; width: 100%; background-color: #FFF; color: #000;">
                    <th ><?php echo __('No');?></th>
                    <th style="padding-left: 4px" ><?php echo __('Admission #');?></th>
                    <th style="padding-left: 4px" ><?php echo __('Student Name');?></th>
                    <th style="text-align: center;" ><?php echo __('Obtain Marks');?></th>
                </tr>

                <?php $s = 0;
                foreach ($student_list as $student){
                    $student_id = $student->student_id;
                    $s++;
                    $title = "Mark Sheet";
                    $param = 'student_id=' . $student_id . "&course_id=" . $c . "&section=" . $sec . "&sid=" . $subject_id . "&t=" . $term;
                    $url = $model . "/add_marks";
                ?>
                <tr>
                    <td><?php echo $s;?></td>
                    <td style="padding-left: 4px"><?php echo $student->admission_number;
                        if($student->message_sent == 'N'){
                        ?>
                        <span style="float: right;" id="cell<?php echo $student->student_id?>"> <button type="button" onclick="onclick_absent('<?php echo $student->student_id?>', this)" class="btn btn-xs red" >Absent</button></span>
                        <?php } ?>
                    </td>
                    <td style="padding-left: 4px; padding-right: 4px"><?php echo $student->student_name;?>
                        <?php if($student->message_sent == 'N'){ ?>
                        <span style="float: right;" <?php echo 'onclick="showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'}, \'tbl_marksheet\')"';?> href="#" class="btn btn-xs blue" ><i class="fa fa-edit"></i></span>
                        <?php }?>
                        <span style="float: right; padding-right: 10px;"><?php #echo $student->student_name_ar;?></span>
                    </td>
                    <td style="padding-left: 4px; padding-right: 4px; text-transform: uppercase" id="obmarks<?=$student->student_id;?>">
                        <input type="text" class="" <?php echo 'onblur="save_this(\''.$student->student_id.'\', this.value)"';?> id="marks<?=$student->student_id;?>" style="border: 0px solid #FFF; text-align: left" tabindex="<?php echo $s;?>" name="marks" value='<?php echo $student->obtained_marks;?>' />
                        <span style="float: right;" <?php echo 'onclick="save_this(\''.$student->student_id.'\', 0)"';?> href="#" class="btn btn-xs red" ><i class="fa fa-save"></i></span>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

</form>
