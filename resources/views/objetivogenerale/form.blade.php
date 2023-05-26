<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Numeral') }}
            {{ Form::text('objetivogeneral', $objetivogenerale->objetivogeneral, ['class' => 'form-control' . ($errors->has('objetivogeneral') ? ' is-invalid' : ''), 'placeholder' => 'Numeral']) }}
            {!! $errors->first('objetivogeneral', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Objetivo General') }}
            {{ Form::textarea('objetivo', $objetivogenerale->objetivo, ['class' => 'ckeditor orm-control' . ($errors->has('objetivo') ? ' is-invalid' : ''), 'placeholder' => 'Objetivo']) }}
            {!! $errors->first('objetivo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Objetivos Estrategicos') }}
            {{ Form::select('estrategico_id', $objetivosestrategico, $objetivogenerale->estrategico_id, ['class' => 'form-control' . ($errors->has('estrategico_id') ? ' is-invalid' : ''), 'placeholder' => 'Selecione una estrategia']) }}
            {!! $errors->first('estrategico_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Registrar</button>
    </div>
</div>