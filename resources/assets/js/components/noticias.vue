<template>
    <div class="m-wizard m-wizard--3 m-wizard--success m-wizard--step-first" id="m_wizard">
        <div class="m-portlet__padding-x">
            <div class="m-alert m-alert--icon alert animated fadeIn" :class="mensaje.clase" role="alert">
                <div class="m-alert__icon">
                    <i :class="mensaje.icono"></i>
                </div>
                <div class="m-alert__text">
                    <span v-html="mensaje.texto"></span>
                </div>
            </div>
        </div>
        <div class="row m-row--no-padding">
            <div class="col-xl-3 col-lg-12">
                <div class="m-wizard__head">
                    <div class="m-wizard__progress">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" :style="'width:'+avance+'%'"></div>
                        </div>
                    </div>
                    <div class="m-wizard__nav">
                        <div class="m-wizard__steps">
                            <div class="m-wizard__step" v-for="(item, index) in lista" v-bind:class="[pasos.actual===index+1?'m-wizard__step--current':(pasos.actual>index+1? 'm-wizard__step--done' :'')]">
                                <div class="m-wizard__step-info">
                                    <a class="m-wizard__step-number">
                                        <span>
                                            <span>
                                                {{index+1}}
                                            </span>
                                        </span>
                                    </a>
                                    <div class="m-wizard__step-line">
                                        <span></span>
                                    </div>
                                    <div class="m-wizard__step-label">
                                        {{item.title}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-12" v-if="!procesando">
                <div class="m-wizard__form">
                    <div class="m-form m-form--label-align-left- m-form--state-">
                        <div class="m-portlet__body m-portlet__body--no-padding">
                            <form class="m-wizard__form-step" v-bind:class="pasos.actual===1?'m-wizard__form-step--current':''" novalidate="novalidate" v-on:submit.prevent="validar" >
                                <div class="m-form__section m-form__section--first">
                                    <div class="m-form__heading">
                                        <h3 class="m-form__heading-title">{{lista[pasos.actual-1].title}}</h3>
                                    </div>
                                    <div class="m-form__section">
                                        <div class="form-group m-form__group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><span class="text-danger">*</span>Nombre de proyecto:</label>
                                            <div class="col-xl-9 col-lg-9">
                                                <input class="form-control m-input" placeholder="Vinculación UNOS" type="text" v-validate="'required'" v-model="titulo" name="nombre proyecto" maxlength="500"/>
                                                <span class="m-form__help text-danger" v-show="errors.has('nombre proyecto')">{{ errors.first('nombre proyecto') }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group m-form__group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Objetivo general:</label>
                                            <div class="col-xl-9 col-lg-9">
                                                <textarea  rows="3" v-model="obgeneral" class="form-control m-input" maxlength="500"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Descripción general:</label>
                                            <div class="col-xl-9 col-lg-9">
                                                <textarea  rows="3" v-model="descripcion" class="form-control m-input" maxlength="500"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Beneficiarios directos:</label>
                                            <div class="col-xl-9 col-lg-9">
                                                <div class="input-group bootstrap-touchspin">
                                                    <input class="form-control m-input bootstrap-touchspin-vertical-btn" placeholder="1000" type="text" v-validate="'numeric|min_value:1'" v-model="benedirectos" name="beneficiarios"/>
                                                    <span class="input-group-btn-vertical">
                                                        <button class="btn btn-secondary bootstrap-touchspin-up" type="button" v-on:click="benedirectos++"><i class="la la-plus"></i></button>
                                                        <button class="btn btn-secondary bootstrap-touchspin-down" type="button" v-on:click="benedirectos--"><i class="la la-minus"></i></button>
                                                    </span>
                                                </div>
                                                <span class="m-form__help text-danger" v-show="errors.has('beneficiarios')">{{errors.first('beneficiarios')}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><span class="text-danger">*</span>Fecha de inicio/Fecha de fin:</label>
                                            <div class="col-xl-9 col-lg-9">
                                                <input class="form-control m-input fechas" placeholder="dd/mm/aaaa - dd/mm/aaaa" type="text" v-validate="'required'" name="fechas"/>
                                                <span class="m-form__help text-danger" v-show="errors.has('fechas')" id="fecha_val">{{ errors.first('fechas') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><span class="text-danger">*</span>Estado de proyecto:</label>
                                            <div class="col-xl-9 col-lg-9">
                                                <select class="form-control m-input m_selectpicker" v-validate="'required'" v-model="estado" name="estado" title="Elija el estado">
                                                    <option v-for="item in listaEstados" :value="item.id">{{item.name}}</option>
                                                </select>
                                                <span class="m-form__help text-danger" v-show="errors.has('estado')">{{ errors.first('estado') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><span class="text-danger">*</span>Se requiere:</label>
                                            <div class="col-xl-9 col-lg-9">
                                                <select class="form-control m-input m_selectpicker" v-validate="'required'" v-model="requiere" name="requerimiento" title="Elija" multiple>
                                                    <option v-for="item in listaReq" :value="item.id">{{item.name}}</option>
                                                </select>
                                                <span class="m-form__help text-danger" v-show="errors.has('requerimiento')">{{errors.first('requerimiento')}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row" v-if="reqOsc">
                                            <label class="col-xl-3 col-lg-3 col-form-label" data-toggle="m-popover" data-placement="top" data-content="Si requiere de OSCs para su proyecto" ><span class="text-danger">*</span>Áreas de trabajo:</label>
                                            <div class="col-xl-9 col-lg-9">
                                                <select class="form-control m-input m_selectpicker" v-validate="'required'" v-model="atrabajo" name="áreas de trabajo" title="OSCs" multiple>
                                                    <option v-for="item in listaAtrabajo" :value="item.id">{{item.name}}</option>
                                                </select>
                                                <span class="m-form__help text-danger" v-show="errors.has('áreas de trabajo')">{{errors.first('áreas de trabajo')}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row" v-if="reqIes">
                                            <label class="col-xl-3 col-lg-3 col-form-label" data-toggle="m-popover" data-placement="top" data-content="Si requiere de Universidades para su proyecto" ><span class="text-danger">*</span>Clasificación de carreras:</label>
                                            <div class="col-xl-9 col-lg-9">
                                                <select class="form-control m-input m_selectpicker" v-validate="'required'" v-model="carreras" name="carreras" title="IES" multiple>
                                                    <option v-for="item in listaCarreras" :value="item.id">{{item.name}}</option>
                                                </select>
                                                <span class="m-form__help text-danger" v-show="errors.has('carreras')">{{errors.first('carreras')}}</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            <form class="m-wizard__form-step" v-if="pasos.actual===2" v-bind:class="pasos.actual===2?'m-wizard__form-step--current':''" novalidate="novalidate" v-on:submit.prevent="validar">
                                <div class="m-form__section m-form__section--first">
                                    <div class="m-form__heading">
                                        <h3 class="m-form__heading-title">{{lista[pasos.actual-1].title}}</h3>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label"><span class="text-danger">*</span>Área de interés</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <select class="form-control m-input m_selectpicker" v-validate="'required'" v-model="ainteres" name="área" title="Elija una área">
                                                <option v-for="item in listaAreas" :value="item.id">{{item.name}}</option>
                                            </select>
                                            <span class="m-form__help text-danger" v-show="errors.has('área')">{{ errors.first('área') }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row" v-if="ainteres>=1">
                                        <label class="col-xl-3 col-lg-3 col-form-label"><span class="text-danger">*</span>País</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <select class="form-control m-input m_selectpicker" v-validate="'required'" v-model="pais" name="país"  data-live-search="true" title="Elija país" >
                                                <option v-for="item in listaPaises" :value="item.id">{{item.name}}</option>
                                            </select>
                                            <span class="m-form__help text-danger" v-show="errors.has('país')">{{ errors.first('país') }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row" v-if="ainteres>=2">
                                        <label class="col-xl-3 col-lg-3 col-form-label"><span class="text-danger">*</span>Provincia</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <select class="form-control m-input m_selectpicker" v-validate="'required'" v-model="provincia" name="provincia"  data-live-search="true" title="Elija provincia" >
                                                <option v-for="item in listaProvincias" :value="item.id">{{item.name}}</option>
                                            </select>
                                            <span class="m-form__help text-danger" v-show="errors.has('provincia')">{{ errors.first('provincia') }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row" v-if="ainteres>=3">
                                        <label class="col-xl-3 col-lg-3 col-form-label"><span class="text-danger">*</span>Cantón</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <select class="form-control m-input m_selectpicker" v-validate="'required'" v-model="canton" name="cantón"  data-live-search="true" title="Elija cantón">
                                                <option v-for="item in listaCantones" :value="item.id">{{item.name}}</option>
                                            </select>
                                            <span class="m-form__help text-danger" v-show="errors.has('cantón')">{{ errors.first('cantón') }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row" v-if="ainteres>=4">
                                        <label class="col-xl-3 col-lg-3 col-form-label"><span class="text-danger">*</span>Parroquia</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <select class="form-control m-input m_selectpicker" v-validate="'required'" v-model="parroquia" name="parroquia"  data-live-search="true" title="Elija parroquia" >
                                                <option v-for="item in listaParroquias" :value="item.id">{{item.name}}</option>
                                            </select>
                                            <span class="m-form__help text-danger" v-show="errors.has('parroquia')">{{ errors.first('parroquia') }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label"><span class="text-danger">*</span>Población</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input class="form-control m-input" placeholder="Puembo" type="text" v-model="poblacion" v-validate="'required'" name="nombre población" maxlength="200"/>
                                            <span class="m-form__help text-danger" v-show="errors.has('nombre población')">{{ errors.first('nombre población') }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <a class="badge badge-success badge-pill" v-for="(item,index) in lugares" :key="item.id" style="color: white">{{item.label}}
                                            <span><a type="button" data-dismiss="modal" class="text-danger del" v-on:click="eliminarLugar(index)">x</a></span>
                                        </a>
                                    </div>
                                    <div class="embed-responsive embed-responsive-4by3">
                                        <gmap-map
                                                :center="centro"
                                                :zoom="acercamiento"
                                                class="embed-responsive-item"
                                                :options="configuracionMap"
                                                @click="clicMapa">
                                            <gmap-info-window :options="info" :opened="true" :position="cordenadas">
                                                <div class="text-center">
                                                    <button type="button" class="btn m-btn m-btn--pill m-btn--air m-btn--gradient-from-metal m-btn--gradient-to-accent" v-on:click="agregarLugar">Agregar</button>
                                                </div>
                                            </gmap-info-window>
                                            <gmap-marker  :key="index+1" v-for="(m,index) in lugares" :position="m" :clickable="false" :draggable="false" :label="m.label"/>
                                            <gmap-marker
                                                    :key="0"
                                                    :position="cordenadas"
                                                    :clickable="true"
                                                    :draggable="true"
                                                    @dragend="clicMapa"
                                                    color="green"
                                            />
                                        </gmap-map>
                                    </div>
                                </div>
                            </form>
                            <div class="m-wizard__form-step" v-bind:class="pasos.actual===3?'m-wizard__form-step--current':''">
                                <div class="m-form__section m-form__section--first">
                                    <div class="m-form__heading">
                                        <h3 class="m-form__heading-title">{{lista[pasos.actual-1].title}}</h3>
                                    </div>
                                    <div class="row">
                                        <label class="m-option col-md-1 col-sm-1" v-for="item in listaArchivos">
                                            <span class="m-option__label">
                                                <span class="m-option__head">
                                                    <span class="m-option__title text-center">
                                                        <h1 class="fiv-cla" :class="'fiv-icon-'+item.ext"></h1>
                                                        <br>
                                                        <small class="text-muted">{{item.name}}</small>
                                                    </span>
                                                </span>
                                                <span class="m-option__body">
                                                    <div class="m-btn-group m-btn-group--pill btn-group btn-group-sm">
                                                        <button type="button" class="m-btn btn btn-danger" v-on:click="eliminarArchivo(item)">
                                                            <i class="la la-remove"></i>
                                                        </button>
                                                        <button type="button" class="m-btn btn btn-success" v-on:click="descargarArchivo(item.file,item.name)">
                                                            <i class="la la la-download"></i>
                                                        </button>
                                                    </div>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <vue-dropzone  id="documentos" :options="dropzoneOptions" ref="archivos" v-on:vdropzone-success="cargarArchivos" v-on:vdropzone-error="cargarArchivos" v-on:sending="cargarArchivos" />
                                </div>
                            </div>
                            <div class="m-wizard__form-step" v-bind:class="pasos.actual===4?'m-wizard__form-step--current':''">
                                <div class="m-accordion m-accordion--default" id="m_accordion_1" role="tablist">
                                    <div class="m-accordion__item active">
                                        <div class="m-accordion__item-head" role="tab" id="m_accordion_1_item_1_head" data-toggle="collapse" href="#m_accordion_1_item_1_body" aria-expanded="  false">
                                            <span class="m-accordion__item-icon">1</span>
                                            <span class="m-accordion__item-title">{{lista[0].title}}</span>
                                            <span class="m-accordion__item-mode"></span>
                                        </div>
                                        <div class="m-accordion__item-body collapse show" id="m_accordion_1_item_1_body" role="tabpanel" aria-labelledby="m_accordion_1_item_1_head" data-parent="#m_accordion_1">
                                            <div class="tab-content active  m--padding-30">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Nombre de proyecto:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static">
                                                                {{titulo}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Estado:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static" v-if="estado>0">
                                                                {{buscar(listaEstados,estado)}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Objetivo general:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static" style="white-space: pre-line">
                                                                {{obgeneral}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Descripción general:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static" style="white-space: pre-line">
                                                                {{descripcion}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Beneficiarios directos:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static">
                                                                {{benedirectos}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Fecha de inicio:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static">
                                                                {{fdeinicio}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Fecha de finalización:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static">
                                                                {{fdefin}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-accordion__item">
                                        <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_1_item_2_head" data-toggle="collapse" href="#m_accordion_1_item_2_body" aria-expanded="    false">
                                            <span class="m-accordion__item-icon">2</span>
                                            <span class="m-accordion__item-title">{{lista[1].title}}</span>
                                            <span class="m-accordion__item-mode"></span>
                                        </div>
                                        <div class="m-accordion__item-body collapse" id="m_accordion_1_item_2_body" role="tabpanel" aria-labelledby="m_accordion_1_item_2_head" data-parent="#m_accordion_1">
                                            <div class="tab-content  m--padding-30">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="m-widget1" v-if="ainteres>0">
                                                        <h4>{{buscar(listaAreas,ainteres)}}</h4>
                                                        <div class="m-widget1__item" v-for="item in lugares">
                                                            <div class="row m-row--no-padding align-items-center">
                                                                <div class="col">
                                                                    <h3 class="m-widget1__title">{{item.label}}</h3>
                                                                    <span class="m-widget1__desc">{{item.name}}</span>
                                                                </div>
                                                                <div class="col m--align-right">
                                                                    <img :src="actual+'/api/google?lat='+item.lat+'&lng='+item.lng"  class="img-fluid"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-accordion__item">
                                        <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_1_item_3_head" data-toggle="collapse" href="#m_accordion_1_item_3_body" aria-expanded="    false">
                                            <span class="m-accordion__item-icon">3</span>
                                            <span class="m-accordion__item-title">{{lista[2].title}} <span>{{listaArchivos.lengh}}</span></span>
                                            <span class="m-accordion__item-mode"></span>
                                        </div>
                                        <div class="m-accordion__item-body collapse" id="m_accordion_1_item_3_body" role="tabpanel" aria-labelledby="m_accordion_1_item_3_head" data-parent="#m_accordion_1">
                                            <div class="tab-content  m--padding-30">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="m-widget4">
                                                        <div class="m-widget4__item" v-for="item in listaArchivos">
                                                            <div class="m-widget4__img m-widget4__img--icon">
                                                                <h1 class="fiv-cla" :class="'fiv-icon-'+item.ext"></h1>
                                                            </div>
                                                            <div class="m-widget4__info">
                                                                <span class="m-widget4__text">
                                                                    {{item.name}}
                                                                </span>
                                                            </div>
                                                            <div class="m-widget4__ext">
                                                                <a class="m-widget4__icon" v-on:click="descargarArchivo(item.file,item.name)" v-if="ver">
                                                                    <i class="la la-download"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                <div class="form-group m-form__group m-form__group--sm row" v-if="ver">
                                    <div class="col-xl-12">
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox m-checkbox--solid m-checkbox--brand">
                                                <input name="accept" :value="true" type="checkbox" v-model="checkVar">
                                                La información es correcta?
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit m--margin-top-40" v-if="ver">
                            <div class="m-form__actions">
                                <div class="row">
                                    <div class="col-lg-6 m--align-left">
                                        <button type="button" class="btn btn-secondary m-btn m-btn--custom m-btn--icon" v-if="pasos.actual>1" v-on:click="pasos.actual--">
                                            <span>
                                                <i class="la la-arrow-left"></i>
                                                <span>
                                                    Atrás
                                                </span>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="col-lg-6 m--align-right">
                                        <button type="button" class="btn btn-primary m-btn m-btn--custom m-btn--icon" v-if="pasos.actual===pasos.total" v-on:click="validar">
                                            <span>
                                                <i class="la la-check"></i>
                                                <span>
                                                    Enviar
                                                </span>
                                            </span>
                                        </button>
                                        <button type="button" class="btn btn-success m-btn m-btn--custom m-btn--icon" v-else v-on:click="validar">
                                            <span>
                                                <span>
                                                    Siguiente
                                                </span>
                                                <i class="la la-arrow-right"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-12" v-else>
                <div class="text-center">
                    <br><br><br>
                    <div class="m-loader m-loader--lg" style="width: 30px; display: inline-block;"></div>
                    <p>Procesando</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import * as VueGoogleMaps from 'vue2-google-maps';
    Vue.component('gmap-autocomplete', VueGoogleMaps.Autocomplete);
    Vue.use(VueGoogleMaps, {
        load: {
            key: 'AIzaSyDAsLUo8OIp0moXk6DH4sV192TRyl2V2NE',
            libraries: 'places',
            language: 'es'
        }
    });

    import vue2Dropzone from 'vue2-dropzone';
    import VeeValidate,{Validator} from 'vee-validate';
    import es from 'vee-validate/dist/locale/es';
    Validator.localize('es',es);
    Vue.use(VeeValidate);
    export default {
        name: "nuevo",
        components: {
            vueDropzone: vue2Dropzone
        },
        data: () => ({
            pasos: {
                actual:1,
                total:5
            },
            ver:true,
            procesando:false,
            lista:{},
            mensaje:{
                clase:'alert-info',
                texto:'Complete el formulario',
                icono:'la la-info-circle'
            },
            dropzoneOptions: {
                url:'/upload',
                maxFiles:10,
                maxFilesize: 5,
                addRemoveLinks: true,
                headers: { "X-CSRF-TOKEN": window.axios.defaults.headers.common['X-CSRF-TOKEN'] },
                uploadMultiple:true,
                dictDefaultMessage: "<h1><i class='fa fa-cloud-upload'></i><br>Arrastre o suba archivos.</h1>",
                dictFallbackMessage:"Su navegador no soporta este componente.",
                dictFileTooBig:"El archivo es muy grande.",
                dictInvalidFileType:"No se admite este tipo de archivo.",
                dictResponseError:"Error al enviar el archivo.",
                dictMaxFilesExceeded:"Solo se admiten 10 archivos.",
                dictRemoveFile:'X',
            },

            titulo:'',
            obgeneral:'',
            obespecificos:'',
            finicio:'',
            ffin:'',
            descripcion:'',
            benedirectos:'',
            beneindirectos:'',
            atrabajo:[],
            carreras:[],
            requiere:[],
            ainteres:null,
            pais:null,
            provincia:null,
            canton:null,
            parroquia:null,
            estado:null,
            lugares:[],
            poblacion:'',
            pa:'',
            checkVar:false,

            cordenadas: {lat:-1.831239, lng:-78.18340599999999},
            buscado:null,
            googlePlace:'',
            intentos:false,
            centro:{},
            info:{
                pixelOffset:{
                    width:0,
                    height:-35
                }
            },

            listaArchivos:[],

            listaAtrabajo:[],
            listaCarreras:[],
            listaEstados:[],
            listaAreas:{},
            listaPaises:{},
            listaProvincias:{},
            listaCantones:{},
            listaParroquias:{},
            listaReq:[{id:1,name:'OSC'},{id:2,name:'IES'},{id:3,name:'No requiere'}],

            place:null,
            acercamiento:6,
            configuracionMap:{
                mapTypeControl:false,
                mapTypeControlOptions:false,
                streetViewControl:false,

            },
        }),
        props:['con'],
        computed:{
            avance:function(){
                return ((this.pasos.actual*100)/this.pasos.total).toFixed(2);
            },
            reqOsc:function(){
                return this.requiere.find(function (element) {
                    return element === 1;
                });
            },
            reqIes:function(){
                return this.requiere.find(function(element) {
                    return element === 2;
                });
            },
            fdeinicio:function(){
                return moment(moment(this.finicio,'YYYY/MM/DD')).format('dddd Do MMMM YYYY');
            },
            fdefin:function(){
                return moment(moment(this.ffin,'YYYY/MM/DD')).format('dddd Do MMMM YYYY');
            },
            actual:function(){
                return window.location.origin;
            }
        },
        watch:{
            ainteres:function(){
                this.lugares=[];
                this.poblacion='';
                this.pais=null;
                this.provincia=null;
                this.canton=null;
                this.parroquia=null;
            },
            pais:function(codigo){
                if(codigo!==null){
                    this.pa=this.buscar(this.listaPaises,codigo);
                    this.buscarPalabra(this.pa);
                    this.acercamiento=4;
                    if(this.ainteres>=2){
                        axios({
                            method: 'POST',
                            url: this.con+'/areas/2/'+codigo,
                        }).then((response) => {
                            this.listaProvincias=response.data;
                        });
                    }
                }
            },
            provincia:function(codigo){
                if(codigo!==null){
                    this.buscarPalabra(this.buscar(this.listaProvincias,codigo)+', '+this.pa);
                    this.acercamiento=10;
                    if(this.ainteres>=3){
                        axios({
                            method: 'POST',
                            url: this.con+'/areas/3/'+codigo,
                        }).then((response) => {
                            this.listaCantones=response.data;
                        });
                    }
                }
            },
            canton:function(codigo){
                if(codigo!==null){
                    this.buscarPalabra(this.buscar(this.listaCantones,codigo)+', '+this.pa);
                    this.acercamiento=13;
                    if(this.ainteres>=4){
                        axios({
                            method: 'POST',
                            url: this.con+'/areas/4/'+codigo,
                        }).then((response) => {
                            this.listaParroquias=response.data;
                        });
                    }
                }
            },
            'pasos.actual':function(val){
                switch (val){
                    case 1:
                        this.mensaje={
                            clase:'alert-info',
                            texto:'Complete el formulario de '+this.lista[0].title,
                            icono:'la la-info-circle'
                        };
                        let vm=this;
                        $('input[name="fechas"]').daterangepicker({
                                autoApply: true,
                                locale: {
                                    format: "MM/DD/YYYY",
                                    separator: " - ",
                                    applyLabel: "Aplicar",
                                    cancelLabel: "Cancelar",
                                    fromLabel: "Desde",
                                    toLabel: "a",
                                },
                                drops: "up"
                            },
                            function(start, end, label) {
                                toastr.info(moment(start.format('YYYY/MM/DD'), "YYYY/MM/DD").fromNow(), "Fecha de inicio");
                                vm.finicio=start.format('YYYY/MM/DD');
                                vm.ffin=end.format('YYYY/MM/DD');
                            }
                        );
                        break;
                    case 2:
                        this.mensaje={
                            clase:'alert-info',
                            texto:'Complete el formulario de '+this.lista[1].title,
                            icono:'la la-info-circle'
                        };
                        break;
                    case 3:
                        this.cargarArchivos();
                        this.$refs.archivos.removeAllFiles();
                        this.mensaje={
                            clase:'alert-success',
                            texto:'Se admiten '+this.dropzoneOptions.maxFiles+' archivos de '+this.dropzoneOptions.maxFilesize+' MB máximo.',
                            icono:'la la-cloud-upload'
                        };
                        break;

                    case 4:
                        this.mensaje={
                            clase:'alert-success',
                            texto:'Compruebe la información ingresada.',
                            icono:'la la-thumbs-up'
                        };
                        break;
                }
            }
        },
        methods:{
            clicMapa:function(e){
                this.cordenadas.lat=e.latLng.lat();
                this.cordenadas.lng=e.latLng.lng();
                this.intentos=false;
            },
            agregarLugar:function(){
                this.$validator.validateAll().then((result) => {
                    if(result){
                        let a = new Object();
                        a.lat=this.cordenadas.lat;
                        a.lng=this.cordenadas.lng;
                        a.label=this.poblacion;
                        switch (this.ainteres) {
                            case 1:
                                a.lugar = this.pais;
                                a.name=this.buscar(this.listaPaises,this.pais);
                                break;
                            case 2:
                                a.lugar = this.provincia;
                                a.name=this.buscar(this.listaProvincias,this.provincia);
                                break;
                            case 3:
                                a.lugar = this.canton;
                                a.name=this.buscar(this.listaCantones,this.canton);
                                break;
                            case 4:
                                a.lugar = this.parroquia;
                                a.name=this.buscar(this.listaParroquias,this.parroquia);
                                break;
                        }
                        this.lugares.push(a);
                        toastr.info("Se agregó a "+this.poblacion, "Lugares");
                        this.poblacion='';
                        this.cordenadas.lng=this.cordenadas.lng-0.0001;
                        this.cordenadas.lat=this.cordenadas.lat+0.0001;
                    }else{
                        toastr.error("Complete el formulario.", "Error");
                    }
                });
            },
            eliminarLugar:function(index){
                this.lugares.splice(index, 1)
            },
            buscarPalabra:function(palabra){
                let geocoder = new google.maps.Geocoder();
                geocoder.geocode({'address': palabra}, (results, status) => {
                    if (status === 'OK') {
                        this.cordenadas.lat = results[0].geometry.location.lat();
                        this.cordenadas.lng = results[0].geometry.location.lng();
                        this.centro.lat=results[0].geometry.location.lat();
                        this.centro.lng=results[0].geometry.location.lng();
                        this.intentos=false;
                    }
                });
            },
            buscar:function(vector,id){
                let item = vector.find(item => item.id === id);
                return item.name;
            },
            cargarCarreras:function(){
                axios({
                    method: 'POST',
                    url: this.con+'/carreras',
                }).then((response) => {
                    this.listaCarreras=response.data;
                });
            },
            cargarTrabajos:function(){
                axios({
                    method: 'POST',
                    url: this.con+'/trabajo',
                }).then((response) => {
                    this.listaAtrabajo=response.data;
                });
            },
            cargarAreas:function(){
                axios({
                    method: 'POST',
                    url: this.con+'/areas',
                }).then((response) => {
                    this.listaAreas=response.data;
                });
            },
            cargarPaises:function(){
                axios({
                    method: 'POST',
                    url: this.con+'/areas/1',
                }).then((response) => {
                    this.listaPaises=response.data;
                });
            },
            cargarEstados:function(){
                axios({
                    method: 'POST',
                    url: this.con+'/estado',
                }).then((response) => {
                    this.listaEstados=response.data;
                });
            },
            cargarArchivos:function(){
                axios({
                    method: 'OPTIONS',
                    url: this.con+'/upload',
                }).then((response) => {
                    this.listaArchivos=response.data;
                });
            },
            descargarArchivo:function(archivo,nombre){
                //window.open(this.con+'/upload?nombre='+archivo,"_blank");
                window.location.href=this.con+'/upload?nombre='+archivo;
                toastr.info("Se descargo "+nombre, "Éxito");
            },
            eliminarArchivo:function(archivo){
                axios({
                    method: 'DELETE',
                    url: this.con+'/upload',
                    params:{
                        'nombre':archivo.file
                    }
                }).then((response) => {
                    toastr.info("Se eliminó "+archivo.name, "Éxito");
                    this.cargarArchivos();
                });
            },
            validar:function(){
                this.errors.clear();
                this.mensaje={
                    clase:'alert-info',
                    texto:'Complete el formulario.',
                    icono:'la la-info-circle'
                };
                switch (this.pasos.actual){
                    case 1:
                        this.$validator.validateAll().then((result) => {
                            if(result)
                                this.pasos.actual++;
                        });
                        break;
                    case 2:
                        if(this.lugares.length>0){
                            this.pasos.actual++;
                        }else{
                            toastr.error("Debe elegir mínimo un lugar.", "Error");
                            this.mensaje={
                                clase:'alert-danger',
                                texto:'Elija el área de interés, posteriormente marque en el mapa las zonas del proyecto.',
                                icono:'la la-ban'
                            };
                        }
                        break;
                    case 3:
                        this.pasos.actual++;
                        break;
                    case 4:
                        if(this.checkVar)
                            this.enviar();
                        else
                            toastr.error("Marque la información es correcta.", "Error");
                        break;
                }
            },
            enviar:function(){
                toastr.info("Se esta procesando la información.", "Información");
                this.procesando=true;
                axios({
                    method: 'POST',
                    url:window.location.href,
                    params: {
                        'proyecto':this.titulo,
                        'estado':this.estado,
                        'objetivo_general':this.obgeneral,
                        'descripcion':this.descripcion,
                        'beneficiarios':this.benedirectos,
                        'areas':this.atrabajo,
                        'carreras':this.carreras,
                        'lugares':this.lugares,
                        'fecha_inicio':this.finicio,
                        'fecha_fin':this.ffin,
                        'interes':this.ainteres,
                    },
                }).then((response) => {
                    if(response.data.val){
                        this.ver=false;
                        this.mensaje={
                            clase:'alert-success',
                            texto:response.data.mensaje,
                            icono:'la la-check'
                        };
                    }else{
                        this.mensaje={
                            clase:'alert-danger',
                            texto:response.data.mensaje,
                            icono:'la la-ban'
                        };
                        this.checkVar=false;
                    }
                    this.procesando=false;
                }).catch((error) => {
                    this.procesando=false;
                    this.checkVar=false;
                    this.mensaje={
                        clase:'alert-danger',
                        texto:'Ha ocurrido un error vuelva a intentar.',
                        icono:'la la-ban'
                    };
                });
            },
        },
        created(){
            this.centro={lat:-1.831239, lng:-78.18340599999999};
            this.lista=[{title:"Proyecto"},{title:"Lugares"},{title:"Archivos"},{title:"Confirmar"}];
            this.pasos.total=this.lista.length;
            this.dropzoneOptions.url=this.con+'/upload';
            this.cargarCarreras();
            this.cargarTrabajos();
            this.cargarAreas();
            this.cargarPaises();
            this.cargarEstados();
        },
        updated(){
            $('.m_selectpicker').selectpicker('refresh');
        },
        mounted(){
            let vm=this;
            $('input[name="fechas"]').daterangepicker({
                    autoApply: true,
                    locale: {
                        format: "MM/DD/YYYY",
                        separator: " - ",
                        applyLabel: "Aplicar",
                        cancelLabel: "Cancelar",
                        fromLabel: "Desde",
                        toLabel: "a",
                    },
                    drops: "up"
                },
                function(start, end, label) {
                    toastr.info(moment(start.format('YYYY/MM/DD'), "YYYY/MM/DD").fromNow(), "Fecha de inicio");
                    vm.finicio=start.format('YYYY/MM/DD');
                    vm.ffin=end.format('YYYY/MM/DD');
                    $('#fecha_val').hide();
                }
            );
            $('input[name="fechas"]').val('');
        }
    }
</script>
<style>
    a{
        cursor: pointer;
    }
    a .del{
        cursor: grab;
    }
    .vue-map {
        background: #fff;
    }
    .pac{
        padding:10px 14px !important;
        width: 60%;
    }
    a[href^="http://maps.google.com/maps"]{display:none !important}
    a[href^="https://maps.google.com/maps"]{display:none !important}

    .gmnoprint a, .gmnoprint span, .gm-style-cc {
        display:none;
    }
    .pac-item{
        cursor:pointer;
    }
    .gm-style-iw + div{
        display: none;
    }
    .gm-style-iw{
        padding-left: 9px;
    }
</style>