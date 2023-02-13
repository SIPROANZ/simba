<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('denominacion') }}
            {{ Form::text('denominacion', $banco->denominacion, ['class' => 'form-control' . ($errors->has('denominacion') ? ' is-invalid' : ''), 'placeholder' => 'Denominacion']) }}
            {!! $errors->first('denominacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>