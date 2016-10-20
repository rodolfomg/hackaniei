@extends('layouts.base_layout')

@section('content')
    <div class="ct-site--map ct-u-backgroundGradient">
        <div class="container">
            <div class="ct-u-displayTableVertical text-capitalize">
                <div class="ct-u-displayTableCell">
                    <span class="ct-u-textBig">
                        Página no encontrada
                    </span>
                </div>
                <div class="ct-u-displayTableCell text-right">
                    <span class="ct-u-textNormal ct-u-textItalic">
                        <a href="/">Inicio</a> / <a href="JavaScript:void(0);">404</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <section class="ct-u-paddingBoth100 text-center ct-u-backgroundLightGreen">
        <div class="container">
            <div class="ct-box404">
                <span class="ct-box404--title">404</span>
                <span class="text-uppercase ct-box404--subTitle ct-fw-700 ct-u-marginBottom40">página no encontrada!</span>
                <div class="ct-box404--description ct-fw-300 ct-u-marginBottom40">
                    <span>Lo sentimos, no pudimos encontrar la página que solicitas.</span>
                    <span>Puedes regresar a</span>
                </div>
                <a href="/" class="btn btn-dark btn-sm"><i class="fa fa-home"></i> Inicio</a>
            </div>
        </div>
    </section>
@stop