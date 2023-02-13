<div class="box box-info padding-1">
    <div class="box-body">
        
    <div class="row">
    <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('Numeral') }}
            {{ Form::text('objetivoestrategico', $objetivosestrategico->objetivoestrategico, ['class' => 'form-control' . ($errors->has('objetivoestrategico') ? ' is-invalid' : ''), 'placeholder' => 'Indique Numeracion']) }}
            {!! $errors->first('objetivoestrategico', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-10">
        <div class="form-group">
            {{ Form::label('Objetivo Estrategico') }}
            {{ Form::text('objetivo', $objetivosestrategico->objetivo, ['class' => 'form-control' . ($errors->has('objetivo') ? ' is-invalid' : ''), 'placeholder' => 'Indique el Objetivo']) }}
            {!! $errors->first('objetivo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        </div>

        <div class="row">
        <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('Objetivo Nacional') }}
            {{ Form::select('nacional_id', $nacionales, $objetivosestrategico->nacional_id, ['class' => 'form-control' . ($errors->has('nacional_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione Objetivo Nacional']) }}
            {!! $errors->first('nacional_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

    </div>

    <br>

    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>