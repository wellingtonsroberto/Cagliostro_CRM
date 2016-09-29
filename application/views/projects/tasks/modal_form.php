<?php echo form_open(get_uri("projects/save_task"), array("id" => "task-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
    <input type="hidden" name="project_id" value="<?php echo $project_id; ?>" />
    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo lang('title'); ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "title",
                "value" => $model_info->title,
                "class" => "form-control",
                "placeholder" => lang('title'),
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="description" class=" col-md-3"><?php echo lang('description'); ?></label>
        <div class=" col-md-9">
            <?php
            echo form_textarea(array(
                "id" => "description",
                "name" => "description",
                "value" => $model_info->description,
                "class" => "form-control",
                "placeholder" => lang('description'),
            ));
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="points" class=" col-md-3"><?php echo lang('points'); ?></label>
        <div class="col-md-9">
            <?php
            echo form_dropdown("points", $points_dropdown, array($model_info->points), "class='select2'");
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="milestone_id" class=" col-md-3"><?php echo lang('milestone'); ?></label>
        <div class="col-md-9">
            <?php
            echo form_dropdown("milestone_id", $milestones_dropdown, array($model_info->milestone_id), "class='select2'");
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="assigned_to" class=" col-md-3"><?php echo lang('assign_to'); ?></label>
        <div class="col-md-9">
            <?php
            echo form_dropdown("assigned_to", $assign_to_dropdown, array($model_info->assigned_to), "class='select2'");
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="status" class=" col-md-3"><?php echo lang('status'); ?></label>
        <div class="col-md-9">
            <?php
            $task_status = array("to_do" => lang('to_do'), "in_progress" => lang('in_progress'), "done" => lang('done'));
            echo form_dropdown("status", $task_status, array($model_info->status), "class='select2'");
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="project_labels" class=" col-md-3"><?php echo lang('labels'); ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "project_labels",
                "name" => "labels",
                "value" => $model_info->labels,
                "class" => "form-control",
                "placeholder" => lang('labels')
            ));
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="deadline" class=" col-md-3"><?php echo lang('deadline'); ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "deadline",
                "name" => "deadline",
                "value" => $model_info->deadline * 1 ? $model_info->deadline : "",
                "class" => "form-control",
                "placeholder" => "YYYY-MM-DD"
            ));
            ?>
        </div>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $("#task-form").appForm({
            onSuccess: function(result) {
                $("#task-table").appTable({newData: result.data, dataId: result.id});
            }
        });
        $("#task-form .select2").select2();
        $("#title").focus();
        $("#start_date, #end_date, #deadline").datepicker({
            autoclose: true,
            format: "yyyy-mm-dd"
        });

        $("#project_labels").select2({
            tags: <?php echo json_encode($label_suggestions); ?>
        });
    });
</script>    