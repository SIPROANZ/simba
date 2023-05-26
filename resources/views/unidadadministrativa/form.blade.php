<div class="box box-info padding-1">
    <div class="box-body">

        <div class="row">
        <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('Ejercicio') }}
                    {{ Form::select('ejercicio_id', $ejercicio, $unidadadministrativa->ejercicio_id, ['class' => 'form-control' . ($errors->has('ejercicio_id') ? ' is-invalid' : ''), 'placeholder' => 'Selecione un ejercicio']) }}
                    {!! $errors->first('ejercicio_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('Institucion') }}
                    {{ Form::select('institucion_id', $instituciones, $unidadadministrativa->institucion_id, ['class' => 'form-control' . ($errors->has('institucion_id') ? ' is-invalid' : ''), 'placeholder' => 'Selecione una institucion']) }}
                    {!! $errors->first('institucion_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('Sector') }}
                    {{ Form::text('sector', $unidadadministrativa->sector, ['class' => 'form-control' . ($errors->has('sector') ? ' is-invalid' : ''), 'placeholder' => 'Sector']) }}
                    {!! $errors->first('sector', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('Programa') }}
                    {{ Form::text('programa', $unidadadministrativa->programa, ['class' => 'form-control' . ($errors->has('programa') ? ' is-invalid' : ''), 'placeholder' => 'Programa']) }}
                    {!! $errors->first('programa', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('Subprograma') }}
                    {{ Form::text('subprograma', $unidadadministrativa->subprograma, ['class' => 'form-control' . ($errors->has('subprograma') ? ' is-invalid' : ''), 'placeholder' => 'Subprograma']) }}
                    {!! $errors->first('subprograma', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('Proyecto') }}
                    {{ Form::text('proyecto', $unidadadministrativa->proyecto, ['class' => 'form-control' . ($errors->has('proyecto') ? ' is-invalid' : ''), 'placeholder' => 'Proyecto']) }}
                    {!! $errors->first('proyecto', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('Actividad') }}
                    {{ Form::text('actividad', $unidadadministrativa->actividad, ['class' => 'form-control' . ($errors->has('actividad') ? ' is-invalid' : ''), 'placeholder' => 'Actividad']) }}
                    {!! $errors->first('actividad', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('Denominacion') }}
                    {{ Form::text('denominacion', $unidadadministrativa->denominacion, ['class' => 'form-control' . ($errors->has('denominacion') ? ' is-invalid' : ''), 'placeholder' => 'Denominación']) }}
                    {!! $errors->first('denominacion', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('Unidad Ejecutora') }}
                    {{ Form::text('unidadejecutora', $unidadadministrativa->unidadejecutora, ['class' => 'form-control' . ($errors->has('unidadejecutora') ? ' is-invalid' : ''), 'placeholder' => 'Unidad Ejecutora']) }}
                    {!! $errors->first('unidadejecutora', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('Nivel') }}
                    {{ Form::text('nivel', $unidadadministrativa->nivel, ['class' => 'form-control' . ($errors->has('nivel') ? ' is-invalid' : ''), 'placeholder' => 'Nivel']) }}
                    {!! $errors->first('nivel', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('Email') }}
                    {{ Form::text('email', $unidadadministrativa->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('Teléfono') }}
                    {{ Form::text('telefono', $unidadadministrativa->telefono, ['class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => 'Teléfono']) }}
                    {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('Descripción') }}
                    {{ Form::text('descripcion', $unidadadministrativa->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripción']) }}
                    {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('Inversión') }}
                    {{ Form::text('inversion', $unidadadministrativa->inversion, ['class' => 'form-control' . ($errors->has('inversion') ? ' is-invalid' : ''), 'placeholder' => 'Inversión']) }}
                    {!! $errors->first('inversion', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('Nivel Ejecutor') }}
                    {{ Form::text('nivelejecutor', $unidadadministrativa->nivelejecutor, ['class' => 'form-control' . ($errors->has('nivelejecutor') ? ' is-invalid' : ''), 'placeholder' => 'Nivel ejecutor']) }}
                    {!! $errors->first('nivelejecutor', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        
        </div>
    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary submit-prevent-button">Crear En Sistema </button>
    </div>
</div>