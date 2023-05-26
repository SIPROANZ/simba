<div class="box box-info padding-1">
    <div class="box-body">
        

        <div class="row"> 
            <div class="col-md-6"> 
            <div class="form-group">
                {{ Form::label('nombre') }}
                {{ Form::text('nombre', $configuracione->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

            <div class="col-md-6"> 
            <div class="form-group">
                {{ Form::label('valor') }}
                {{ Form::text('valor', $configuracione->valor, ['class' => 'form-control' . ($errors->has('valor') ? ' is-invalid' : ''), 'placeholder' => 'Valor']) }}
                {!! $errors->first('valor', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

            <div class="col-md-12"> 
            <div class="form-group">
                {{ Form::label('descripcion') }}
                <textarea class="ckeditor form-control" name="descripcion">{{ $configuracione->descripcion }}</textarea>
            
               
                {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

        </div>
        

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
    </div>
</div>