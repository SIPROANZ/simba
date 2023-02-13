<div class="box box-info padding-1">
    <div class="box-body">

       <div class="row">
      
            <div class="col-sm-3">
                    <div class="form-group">
                        {{ Form::label('Ejercicio') }}
                        {{ Form::select('ejercicio_id', $ejercicio, $ejecucione->ejercicio_id, ['class' => 'form-control' . ($errors->has('ejercicio_id') ? ' is-invalid' : ''), 'placeholder' => 'Ejercicio']) }}
                        {!! $errors->first('ejercicio_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    {{ Form::label('Institucion') }}
                    {{ Form::select('institucion_id', $institucion, $ejecucione->institucion_id, ['class' => 'form-control' . ($errors->has('institucion_id') ? ' is-invalid' : ''), 'placeholder' => 'Institucion']) }}
                    {!! $errors->first('institucion_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    {{ Form::label('Unidadadministrativa') }}
                    {{ Form::select('unidadadministrativa_id', $unidadadministrativa, $ejecucione->unidadadministrativa_id, ['class' => 'form-control' . ($errors->has('unidadadministrativa_id') ? ' is-invalid' : ''), 'placeholder' => 'Unidadadministrativa']) }}
                    {!! $errors->first('unidadadministrativa_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {{ Form::label('Meta') }}
                    {{ Form::select('meta_id', $meta, $ejecucione->meta_id, ['class' => 'form-control' . ($errors->has('meta_id') ? ' is-invalid' : ''), 'placeholder' => 'Meta']) }}
                    {!! $errors->first('meta_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {{ Form::label('Clasificador presupuestario') }}
                    {{ Form::text('clasificadorpresupuestario', $ejecucione->clasificadorpresupuestario, ['class' => 'form-control' . ($errors->has('clasificadorpresupuestario') ? ' is-invalid' : ''), 'placeholder' => 'Clasificador presupuestario']) }}
                    {!! $errors->first('clasificadorpresupuestario', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {{ Form::label('Financiamiento') }}
                    {{ Form::select('financiamiento_id',$financiamiento, $ejecucione->financiamiento_id, ['class' => 'form-control' . ($errors->has('financiamiento_id') ? ' is-invalid' : ''), 'placeholder' => 'Financiamiento']) }}
                    {!! $errors->first('financiamiento_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {{ Form::label('Monto inicial') }}
                    {{ Form::text('monto_inicial', $ejecucione->monto_inicial, ['class' => 'form-control' . ($errors->has('monto_inicial') ? ' is-invalid' : ''), 'placeholder' => 'Monto Inicial']) }}
                    {!! $errors->first('monto_inicial', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {{ Form::label('Monto aumento') }}
                    {{ Form::text('monto_aumento', $ejecucione->monto_aumento, ['class' => 'form-control' . ($errors->has('monto_aumento') ? ' is-invalid' : ''), 'placeholder' => 'Monto Aumento']) }}
                    {!! $errors->first('monto_aumento', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {{ Form::label('Monto disminuye') }}
                    {{ Form::text('monto_disminuye', $ejecucione->monto_disminuye, ['class' => 'form-control' . ($errors->has('monto_disminuye') ? ' is-invalid' : ''), 'placeholder' => 'Monto Disminuye']) }}
                    {!! $errors->first('monto_disminuye', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {{ Form::label('Monto actualizado') }}
                    {{ Form::text('monto_actualizado', $ejecucione->monto_actualizado, ['class' => 'form-control' . ($errors->has('monto_actualizado') ? ' is-invalid' : ''), 'placeholder' => 'Monto Actualizado']) }}
                    {!! $errors->first('monto_actualizado', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {{ Form::label('Monto precomprometido') }}
                    {{ Form::text('monto_precomprometido', $ejecucione->monto_precomprometido, ['class' => 'form-control' . ($errors->has('monto_precomprometido') ? ' is-invalid' : ''), 'placeholder' => 'Monto Precomprometido']) }}
                    {!! $errors->first('monto_precomprometido', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>  
            <div class="col-sm-3">
                <div class="form-group">
                    {{ Form::label('Monto comprometido') }}
                    {{ Form::text('monto_comprometido', $ejecucione->monto_comprometido, ['class' => 'form-control' . ($errors->has('monto_comprometido') ? ' is-invalid' : ''), 'placeholder' => 'Monto Comprometido']) }}
                    {!! $errors->first('monto_comprometido', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>  
            <div class="col-sm-3">
                <div class="form-group">
                    {{ Form::label('Monto causado') }}
                    {{ Form::text('monto_causado', $ejecucione->monto_causado, ['class' => 'form-control' . ($errors->has('monto_causado') ? ' is-invalid' : ''), 'placeholder' => 'Monto Causado']) }}
                    {!! $errors->first('monto_causado', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>    
            <div class="col-sm-3">
                <div class="form-group">
                    {{ Form::label('Monto pagado') }}
                    {{ Form::text('monto_pagado', $ejecucione->monto_pagado, ['class' => 'form-control' . ($errors->has('monto_pagado') ? ' is-invalid' : ''), 'placeholder' => 'Monto Pagado']) }}
                    {!! $errors->first('monto_pagado', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {{ Form::label('Monto_por_comprometer') }}
                    {{ Form::text('monto_por_comprometer', $ejecucione->monto_por_comprometer, ['class' => 'form-control' . ($errors->has('monto_por_comprometer') ? ' is-invalid' : ''), 'placeholder' => 'Monto Por Comprometer']) }}
                    {!! $errors->first('monto_por_comprometer', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {{ Form::label('Monto_por_causar') }}
                    {{ Form::text('monto_por_causar', $ejecucione->monto_por_causar, ['class' => 'form-control' . ($errors->has('monto_por_causar') ? ' is-invalid' : ''), 'placeholder' => 'Monto Por Causar']) }}
                    {!! $errors->first('monto_por_causar', '<div class="invalid-feedback">:message</div>') !!}
                </div>
             </div>
             <div class="col-sm-3">
                <div class="form-group">
                    {{ Form::label('Monto_por_pagar') }}
                    {{ Form::text('monto_por_pagar', $ejecucione->monto_por_pagar, ['class' => 'form-control' . ($errors->has('monto_por_pagar') ? ' is-invalid' : ''), 'placeholder' => 'Monto Por Pagar']) }}
                    {!! $errors->first('monto_por_pagar', '<div class="invalid-feedback">:message</div>') !!}
                </div>
             </div>
             <div class="col-sm-3">
                <div class="form-group">
                    {{ Form::label('Poa_id') }}
                    {{ Form::select('poa_id',$poa, $ejecucione->poa_id, ['class' => 'form-control' . ($errors->has('poa_id') ? ' is-invalid' : ''), 'placeholder' => 'Poa Id']) }}
                    {!! $errors->first('poa_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
             </div>
        </div>
    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>