<div class="box box-info padding-1">
    <div class="box-body">
            <div class="row">
    <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('Numeral') }}
            {{ Form::text('objetivomunicipal', $objetivomunicipale->objetivomunicipal, ['class' => 'form-control' . ($errors->has('objetivomunicipal') ? ' is-invalid' : ''), 'placeholder' => 'Objetivomunicipal']) }}
            {!! $errors->first('objetivomunicipal', '<div class="invalid-feedback">:message</div>') !!}
        </div>
          </div>
  
                <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('objetivo') }}
            {{ Form::textarea('objetivo', $objetivomunicipale->objetivo, ['class' => 'ckeditor form-control' . ($errors->has('objetivo') ? ' is-invalid' : ''), 'placeholder' => 'Objetivo']) }}
            {!! $errors->first('objetivo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
              </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>
</div>