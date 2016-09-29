<div class="media b-b p15 m0 bg-white">
    <div class="media-left">
        <span class="avatar avatar-sm">
            <img src="<?php echo get_avatar($reply_info->user_image); ?>" alt="..." />
        </span>
    </div>
    <div class="media-body w100p">
        <div class="media-heading">
            <strong><?php
                if ($reply_info->from_user_id === $this->login_user->id) {
                    echo lang("me");
                } else {
                    echo get_team_member_profile_link($reply_info->from_user_id, $reply_info->user_name, array("class" => "dark strong"));
                }
                ?>
            </strong>
            <span class="text-off pull-right"><?php echo format_to_relative_time($reply_info->created_at); ?></span>
        </div>
        <p><?php echo nl2br(link_it($reply_info->message)); ?></p>
    </div>
</div>