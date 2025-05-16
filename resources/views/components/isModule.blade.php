<div class="form-check form-switch">
    <input id="checkbox-switch-{{$title}}-<?php echo $v->id; ?>" <?php echo ($v->$title == 1) ? 'checked=""' : ''; ?>
        class="form-check-input publish-ajax" type="checkbox" data-module="{{$module}}" data-view-home="{{$module == 'category_products' ? $v->view_home : 0 }}" data-id="<?php echo $v->id; ?>"
        data-title="{{$title}}">
</div>
