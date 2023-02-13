<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Codigo clase') }}
            {{ Form::text('codigoclase', $clase->codigoclase, ['class' => 'form-control' . ($errors->has('codigoclase') ? ' is-invalid' : ''), 'placeholder' => 'Codigo clase']) }}
            {!! $errors->first('codigoclase', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('nombre', $clase->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Familia_id') }}
            {{ Form::select('familia_id', $familia, $clase->familia_id, ['class' => 'form-control' . ($errors->has('familia_id') ? ' is-invalid' : ''), 'placeholder' => 'Selecione una familia']) }}
            {!! $errors->first('familia_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>