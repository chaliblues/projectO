        
<div id="modal_cnt_add_opinion" title="Add opinion">
    <?php
    $options_type = array('0' => 'Select opinion type');
    $options_category = array(0 => 'Select a category');
    foreach ($opinionTypes as $opinionType) {
        $typeID = $opinionType['opinionTypeID'];
        $typeName = $opinionType['opinionTypeName'];

        $options_type[$typeID] = $typeName;
    }

    foreach ($opinionCategories as $opinionCategory) {
        $catID = $opinionCategory['opinionCategoryID'];
        $catName = $opinionCategory['categoryName'];
        $options_category[$catID] = $catName;
    }
    ?>
    <form name="ajax_form" id ="ajax_form" method="post">

        Title*<input type="text" name="opinion_title" id="opinion_title" value="" size="30" /><br/><br/>
        Type*<?php
    $js = 'id="opinion_type"';
    echo form_dropdown('opinion_type', $options_type, "0", $js);
    ?>

        <p>Category*<?php
        $js = 'id="opinion_category"'; // onChange="some_function();"';
        echo form_dropdown('opinion_category', $options_category, 0, $js);
    ?>

        <p>Sub Category*
            <?php
            $js = 'id="opinion_sub_category"';
            echo form_dropdown('opinion_sub_category', array(0 => 'Select sub category'), null, $js);
            ?>
        <p>
            Narration*
            <?php
            $data = array(
                'name' => 'opinion_text',
                'id' => 'opinion_text',
                'value' => '',
                'cols' => '10',
                'rows' => '5',
                'style' => 'width:50%',
            );

            echo form_textarea($data);
            ?>

    </form>
    <p>
    <div id="success" name="success"></div>

</div>


<div id="modal_review_opinion" title="Review opinion">
    <form name="ajax_form" id ="ajax_form" method="post">
        <label for="title" id="modal_opinion_title"></label><br/><br/>
        Comment*
        <?php
        $data = array(
            'name' => 'opinion_text',
            'id' => 'comment',
            'value' => '',
            'cols' => '10',
            'rows' => '5',
            'style' => 'width:50%',
        );

        echo form_textarea($data);
        ?>
        <?php
        if (!isset($userID)) { 
            ?>
            <br/><br/>Name*<input type="text" name="opinion_reviews_name" id="opinion_reviews_name" value="" size="30" /><br/><br/>
            <?php
        } else {
            ?>
            <input type="hidden" name="opinion_reviews_name" id="opinion_reviews_name" value="NOT_REQUIRED"/>
            <input type="hidden" name="opinion_reviews_user_id" id="opinion_reviews_user_id" value="<?php echo $userID; ?>" />
           
            <?php
        }
        ?>
    </form>
    <p>
    <div id="comment_status" name="comment_status"></div>

</div>

<!--static dialog-->
<div id="modal_view_comments" title="Opinions">
    <p>
    <div id="opinion_reviews_title"></div>
</p>
<p>
<div id="opinion_reviews"></div>
</p>

</div>

<div id="modal_no_comments" title="No Comments">
    <p>
        No comments for that opinion
    </p>

</div>

<!--static dialog-->
<div id="dialog-message-comment" title="Success">
    <p>
        <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
        Comment added successfully
    </p>

</div>

<!--static dialog-->
<div id="dialog-message" title="Success">
    <p>
        <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
        Your opinion has successfully been added.
    </p>

</div>
<!--static dialog-->
<div id="dialog-message-add-opinion-not-logged-in" title="Success">
    <p>
        <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
        You must be logged in to add an opinion
    </p>

</div>
<!--static dialog-->
<div id="dialog-message-vote" title="Success">
    <p>
        <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
        You have successfully voted.
    </p>

</div>
<!--end static dialog-->

<div id="dialog-message-already-voted" title="Success">
    <p>
        <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
        You had already voted
    </p>

</div>

<div id="dialog-message-voting-failure" title="Success">
    <p>
        <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
        Error in voting
    </p>

</div>