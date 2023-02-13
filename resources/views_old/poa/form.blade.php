<div class="box box-info padding-1">
    <div class="box-body">
    <div class="row">
        
        <div class="col-md-3">   
        <div class="form-group">
            {{ Form::label('Ejercicio') }}
            {{ Form::select('ejercicio_id', $ejercicios, $poa->ejercicio_id, ['class' => 'form-control' . ($errors->has('ejercicio_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el ejercicio']) }}
            {!! $errors->first('ejercicio_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Institucion') }}
            {{ Form::select('institucion_id', $instituciones, $poa->institucion_id, ['class' => 'form-control' . ($errors->has('institucion_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione la institucion']) }}
            {!! $errors->first('institucion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Historico') }}
            {{ Form::select('historico_id', $objetivoshistoricos, $poa->historico_id, ['class' => 'form-control' . ($errors->has('historico_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el Historico']) }}
            {!! $errors->first('historico_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Nacional') }}
            {{ Form::select('nacional_id', $objetivonacionales, $poa->nacional_id, ['class' => 'form-control' . ($errors->has('nacional_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el Nacional']) }}
            {!! $errors->first('nacional_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Estrategico') }}
            {{ Form::select('estrategico_id', $objetivosestrategicos, $poa->estrategico_id, ['class' => 'form-control' . ($errors->has('estrategico_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el Estrategico']) }}
            {!! $errors->first('estrategico_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('General') }}
            {{ Form::select('general_id', $objetivogenerales, $poa->general_id, ['class' => 'form-control' . ($errors->has('general_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el General']) }}
            {!! $errors->first('general_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Municipal') }}
            {{ Form::select('municipal_id', $objetivomunicipales, $poa->municipal_id, ['class' => 'form-control' . ($errors->has('municipal_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el Municipal']) }}
            {!! $errors->first('municipal_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Pei') }}
            {{ Form::select('pei_id', $objetivopeis, $poa->pei_id, ['class' => 'form-control' . ($errors->has('pei_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el Pei']) }}
            {!! $errors->first('pei_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Unidad administrativa') }}
            {{ Form::select('unidadadministrativa_id', $unidadadministrativas, $poa->unidadadministrativa_id, ['class' => 'form-control' . ($errors->has('unidadadministrativa_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione la Unidad administrativa']) }}
            {!! $errors->first('unidadadministrativa_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Proyecto') }}
            {{ Form::text('proyecto', $poa->proyecto, ['class' => 'form-control' . ($errors->has('proyecto') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('proyecto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Objetivo proyecto') }}
            {{ Form::text('objetivoproyecto', $poa->objetivoproyecto, ['class' => 'form-control' . ($errors->has('objetivoproyecto') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('objetivoproyecto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Monto proyecto') }}
            {{ Form::text('montoproyecto', $poa->montoproyecto, ['class' => 'form-control' . ($errors->has('montoproyecto') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('montoproyecto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Responsable') }}
            {{ Form::text('responsable', $poa->responsable, ['class' => 'form-control' . ($errors->has('responsable') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('responsable', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Tipo') }}
            {{ Form::text('tipo', $poa->tipo, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('SNCF estrategico') }}
            {{ Form::text('sncfestrategico', $poa->sncfestrategico, ['class' => 'form-control' . ($errors->has('sncfestrategico') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('sncfestrategico', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('SNCF especifico') }}
            {{ Form::text('sncfespecifico', $poa->sncfespecifico, ['class' => 'form-control' . ($errors->has('sncfespecifico') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('sncfespecifico', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('P. social') }}
            {{ Form::text('psocial', $poa->psocial, ['class' => 'form-control' . ($errors->has('psocial') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('psocial', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Codigo') }}
            {{ Form::text('codigo', $poa->codigo, ['class' => 'form-control' . ($errors->has('codigo') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('codigo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Tipoproyecto') }}
            {{ Form::text('tipoproyecto', $poa->tipoproyecto, ['class' => 'form-control' . ($errors->has('tipoproyecto') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('tipoproyecto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Central') }}
            {{ Form::text('central', $poa->central, ['class' => 'form-control' . ($errors->has('central') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('central', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Descripcion') }}
            {{ Form::text('descripcion', $poa->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            </div>

</div>


</div>

<br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>