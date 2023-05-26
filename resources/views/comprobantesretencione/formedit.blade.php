<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{-- Form::label('tiporetencion_id') --}}
            {{ Form::hidden('tiporetencion_id', $comprobantesretencione->tiporetencion_id, ['class' => 'form-control' . ($errors->has('tiporetencion_id') ? ' is-invalid' : ''), 'placeholder' => 'Tiporetencion Id']) }}
            {!! $errors->first('tiporetencion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{-- Form::label('ordenpago_id') --}}
            {{ Form::hidden('ordenpago_id', $comprobantesretencione->ordenpago_id, ['class' => 'form-control' . ($errors->has('ordenpago_id') ? ' is-invalid' : ''), 'placeholder' => 'Ordenpago Id']) }}
            {!! $errors->first('ordenpago_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{-- Form::label('montoretencion') --}}
            {{ Form::hidden('montoretencion', $comprobantesretencione->montoretencion, ['class' => 'form-control' . ($errors->has('montoretencion') ? ' is-invalid' : ''), 'placeholder' => 'Montoretencion']) }}
            {!! $errors->first('montoretencion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="row">

            <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('Cambiar Estatus') }}
            {{ Form::select('status', ['AP' => 'Entregado', 'EP'=>'En Proceso', 'AN'=>'Anulado'], ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary submit-prevent-button">Enviar</button>
    </div>
</div>