<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('objetivomunicipal') }}
            {{ Form::text('objetivomunicipal', $objetivomunicipale->objetivomunicipal, ['class' => 'form-control' . ($errors->has('objetivomunicipal') ? ' is-invalid' : ''), 'placeholder' => 'Objetivomunicipal']) }}
            {!! $errors->first('objetivomunicipal', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('objetivo') }}
            {{ Form::text('objetivo', $objetivomunicipale->objetivo, ['class' => 'form-control' . ($errors->has('objetivo') ? ' is-invalid' : ''), 'placeholder' => 'Objetivo']) }}
            {!! $errors->first('objetivo', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>