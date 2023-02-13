<div class="box box-info padding-1">
    <div class="box-body">
        
    <div class="row">
    <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('objetivonacional') }}
            {{ Form::text('objetivonacional', $objetivonacionale->objetivonacional, ['class' => 'form-control' . ($errors->has('objetivonacional') ? ' is-invalid' : ''), 'placeholder' => 'Objetivonacional']) }}
            {!! $errors->first('objetivonacional', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-10">
        <div class="form-group">
            {{ Form::label('Objetivo Nacional') }}
            {{ Form::text('objetivo', $objetivonacionale->objetivo, ['class' => 'form-control' . ($errors->has('objetivo') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese el Objetivo Nacional']) }}
            {!! $errors->first('objetivo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

        <div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('Objetivos Historicos') }}
            {{ Form::select('historico_id', $historicos, $objetivonacionale->historico_id, ['class' => 'form-control' . ($errors->has('historico_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el Objetivo Historico']) }}
            {!! $errors->first('historico_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>