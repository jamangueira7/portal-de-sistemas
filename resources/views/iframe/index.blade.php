@extends('template.master')
@section('menu-search')
    <input type="text" id="myInput" onkeyup="mySearchFunction()" placeholder="Filtrar Menu" class="input form-control-sm border-0">
@stop
@section('conteudo-css')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>

    <style type="text/css">

        .navbar .megamenu{ padding: 1rem; }

        li {
            list-style-type: none;
        }

        .col-megamenu, .col-megamenu h6 {
            font-size: 13px;
        }

        .has-megamenu > a  {
            font-size: 13px;
            font-weight: 500;
            color: #5b5b5b;
        }

        /* ============ desktop view ============ */
        @media all and (min-width: 992px) {

            .navbar .has-megamenu{position:static!important;}
            .navbar .megamenu{left:0; right:0; width:100%; margin-top:0;  }

        }
        /* ============ desktop view .end// ============ */


        /* ============ mobile view ============ */
        @media(max-width: 991px){
            .navbar.fixed-top .navbar-collapse, .navbar.sticky-top .navbar-collapse{
                overflow-y: auto;
                max-height: 90vh;
                margin-top:10px;
            }
        }
        /* ============ mobile view .end// ============ */
    </style>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(){
            /////// Prevent closing from click inside dropdown
            document.querySelectorAll('.dropdown-menu').forEach(function(element){
                element.addEventListener('click', function (e) {
                    e.stopPropagation();
                });
            })
        });
    </script>
    <script>
        window.console = window.console || function(t) {};
    </script>



    <script>
        if (document.location.search.match(/type=embed/gi)) {
            window.parent.postMessage("resize", "*");
        }
    </script>
@stop
@section('conteudo-view')

<div class="container-fluid bg-white bg-white mb-2 shadow-sm">
    <div class="row d-flex justify-content-between">
      <div class="col-2 logo d-flex">

        <a href="{{ route('free.index') }}">
          <!-- <img src="/img/cropped-logo-160x60-1.png" class="pl-2"> -->
          <img src="{{ asset('/img/cropped-logo-160x60-1.png') }}" class="pl-2">

        </a>
      </div>

      <div class="col-10 d-flex">
          <div class="container">
              <nav class="navbar navbar-expand-lg">
                  <div class="container-fluid">
                      <div class="collapse navbar-collapse" id="main_nav">
                            {{\App\Helpers\Helper::gerarFilhos($page, $page['page']['slug'])}}
                      </div> <!-- navbar-collapse.// -->
                  </div> <!-- container-fluid.// -->
              </nav>
          </div>
      </div>
    </div>
</div>
<div class="container-fluid">

  <div class="row">
    <div class="col-9">
      <nav aria-label="breadcrumb">
          {{\App\Helpers\Helper::generateBreadcrumb($page, $current)}}
      </nav>
    </div>
      <div class="col-2">
          <a
              target="_blank"
              href="{{ route(!empty($current) ? 'admin.items.details' : 'admin.pages.details', [!empty($current) ? $current['id'] : $page['page']['id']]) }}"
              class="btn btn-lg btn-gradient"
              data-title="Detalhe"
              style="display: {!! session('userAccess') == true && empty($current) ? 'block' : 'none' !!};"
          >Detalhe</a>
      </div>
    <div class="col-1">
        <input id="slug-type" type="hidden" value="{{ !empty($current) ? 'item' : 'page' }}">
        <input id="desc-current" type="hidden" value="{{ !empty($current) ? $current['title'] : $page['page']['description'] }}">
        <input id="id-current" type="hidden" value="{{ !empty($current) ? $current['id'] : $page['page']['id'] }}">

        <a
            href="#"
           id="favorite-on"
           class="btn btn-lg btn-gradient"
            data-title="Clique para retirar dos favoritos"
           style="display: {!! !$favorite ? 'none' : 'block' !!};"
        >
          <i class="fas fa-star"></i>
        </a>

        <a
            href="#"
            id="favorite-off"
            class="btn btn-lg btn-gradient"
            data-title="Clique para colocar nos favoritos"
            style="display: {!! $favorite ? 'none' : 'block' !!};"
        >
            <i class="far fa-star"></i>

        </a>
    </div>
  </div>
</div>
        <div class="container-fluid">


          @if(!empty($current))
              <article>
                  <iframe src="{{ $current['url'] }}"
                          id="iframe_funcionalidade" name="iframe_funcionalidade" frameborder="0" style="width: 100%; height: 75vh" scrolling="auto"></iframe>
              </article>
          @endif
        </div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Como quer nomear esse favorito?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" name="fav" id="fav">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-lg btn-outline-success" id="modal-btn-save" style="width:150px">Guardar</button>
            </div>
        </div>
    </div>
</div>

@stop

@section('js-view')
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.0.min.js"></script>
    <script>

        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#favorite-off").on('click', function(e) {
                e.preventDefault();

                $("#fav").val($("#desc-current").val());
                $("#mi-modal").modal('show');
            });

            $("#modal-btn-save").on('click', function(e) {
                e.preventDefault();
                $("#mi-modal").modal('hide');
                favOff();
            });

            function favOff() {
                var url = "{{ route('portal.ajax.favorite.alter') }}";

                $.ajax({
                    type:'POST',
                    url: url,
                    data:{
                        slug_type:  $("#slug-type").val(),
                        id_current:  $("#id-current").val(),
                        desc:  $("#fav").val(),
                        delete:  'include',
                    },

                    success:function(data){
                        $("#favorite-on").css("display", "block");
                        $("#favorite-off").css("display", "none");
                    },

                    error:function(data){
                        console.log('Erro no Ajax!');
                    },

                });
            }

            $("#favorite-on").on('click', function(e) {
                e.preventDefault();
                var url = "{{ route('portal.ajax.favorite.alter') }}";

                $.ajax({
                    type:'POST',
                    url: url,
                    data:{
                        slug_type:  $("#slug-type").val(),
                        id_current:  $("#id-current").val(),
                        delete:  'delete',
                    },

                    success:function(data){
                        $("#favorite-on").css("display", "none");
                        $("#favorite-off").css("display", "block");
                    },

                    error:function(data){
                        console.log('Erro no Ajax!');
                    },

                });

            });
        });
    </script>
    <script id="rendered-js">
        window.HUB_EVENTS={ASSET_ADDED:"ASSET_ADDED",ASSET_DELETED:"ASSET_DELETED",ASSET_DESELECTED:"ASSET_DESELECTED",ASSET_SELECTED:"ASSET_SELECTED",ASSET_UPDATED:"ASSET_UPDATED",CONSOLE_CHANGE:"CONSOLE_CHANGE",CONSOLE_CLOSED:"CONSOLE_CLOSED",CONSOLE_EVENT:"CONSOLE_EVENT",CONSOLE_OPENED:"CONSOLE_OPENED",CONSOLE_RUN_COMMAND:"CONSOLE_RUN_COMMAND",CONSOLE_SERVER_CHANGE:"CONSOLE_SERVER_CHANGE",EMBED_ACTIVE_PEN_CHANGE:"EMBED_ACTIVE_PEN_CHANGE",EMBED_ACTIVE_THEME_CHANGE:"EMBED_ACTIVE_THEME_CHANGE",EMBED_ATTRIBUTE_CHANGE:"EMBED_ATTRIBUTE_CHANGE",EMBED_RESHOWN:"EMBED_RESHOWN",FORMAT_FINISH:"FORMAT_FINISH",FORMAT_ERROR:"FORMAT_ERROR",FORMAT_START:"FORMAT_START",IFRAME_PREVIEW_RELOAD_CSS:"IFRAME_PREVIEW_RELOAD_CSS",IFRAME_PREVIEW_URL_CHANGE:"IFRAME_PREVIEW_URL_CHANGE",KEY_PRESS:"KEY_PRESS",LINTER_FINISH:"LINTER_FINISH",LINTER_START:"LINTER_START",PEN_CHANGE_SERVER:"PEN_CHANGE_SERVER",PEN_CHANGE:"PEN_CHANGE",PEN_EDITOR_CLOSE:"PEN_EDITOR_CLOSE",PEN_EDITOR_CODE_FOLD:"PEN_EDITOR_CODE_FOLD",PEN_EDITOR_ERRORS:"PEN_EDITOR_ERRORS",PEN_EDITOR_EXPAND:"PEN_EDITOR_EXPAND",PEN_EDITOR_FOLD_ALL:"PEN_EDITOR_FOLD_ALL",PEN_EDITOR_LOADED:"PEN_EDITOR_LOADED",PEN_EDITOR_REFRESH_REQUEST:"PEN_EDITOR_REFRESH_REQUEST",PEN_EDITOR_RESET_SIZES:"PEN_EDITOR_RESET_SIZES",PEN_EDITOR_SIZES_CHANGE:"PEN_EDITOR_SIZES_CHANGE",PEN_EDITOR_UI_CHANGE_SERVER:"PEN_EDITOR_UI_CHANGE_SERVER",PEN_EDITOR_UI_CHANGE:"PEN_EDITOR_UI_CHANGE",PEN_EDITOR_UI_DISABLE:"PEN_EDITOR_UI_DISABLE",PEN_EDITOR_UI_ENABLE:"PEN_EDITOR_UI_ENABLE",PEN_EDITOR_UNFOLD_ALL:"PEN_EDITOR_UNFOLD_ALL",PEN_ERROR_INFINITE_LOOP:"PEN_ERROR_INFINITE_LOOP",PEN_ERROR_RUNTIME:"PEN_ERROR_RUNTIME",PEN_ERRORS:"PEN_ERRORS",PEN_LIVE_CHANGE:"PEN_LIVE_CHANGE",PEN_LOGS:"PEN_LOGS",PEN_MANIFEST_CHANGE:"PEN_MANIFEST_CHANGE",PEN_MANIFEST_FULL:"PEN_MANIFEST_FULL",PEN_PREVIEW_FINISH:"PEN_PREVIEW_FINISH",PEN_PREVIEW_START:"PEN_PREVIEW_START",PEN_SAVED:"PEN_SAVED",POPUP_CLOSE:"POPUP_CLOSE",POPUP_OPEN:"POPUP_OPEN",POST_CHANGE:"POST_CHANGE",POST_SAVED:"POST_SAVED",PROCESSING_FINISH:"PROCESSING_FINISH",PROCESSING_START:"PROCESSED_STARTED"},"object"!=typeof window.CP&&(window.CP={}),window.CP.PenTimer={programNoLongerBeingMonitored:!1,timeOfFirstCallToShouldStopLoop:0,_loopExits:{},_loopTimers:{},START_MONITORING_AFTER:2e3,STOP_ALL_MONITORING_TIMEOUT:5e3,MAX_TIME_IN_LOOP_WO_EXIT:2200,exitedLoop:function(E){this._loopExits[E]=!0},shouldStopLoop:function(E){if(this.programKilledSoStopMonitoring)return!0;if(this.programNoLongerBeingMonitored)return!1;if(this._loopExits[E])return!1;var _=this._getTime();if(0===this.timeOfFirstCallToShouldStopLoop)return this.timeOfFirstCallToShouldStopLoop=_,!1;var o=_-this.timeOfFirstCallToShouldStopLoop;if(o<this.START_MONITORING_AFTER)return!1;if(o>this.STOP_ALL_MONITORING_TIMEOUT)return this.programNoLongerBeingMonitored=!0,!1;try{this._checkOnInfiniteLoop(E,_)}catch(N){return this._sendErrorMessageToEditor(),this.programKilledSoStopMonitoring=!0,!0}return!1},_sendErrorMessageToEditor:function(){try{if(this._shouldPostMessage()){var E={topic:HUB_EVENTS.PEN_ERROR_INFINITE_LOOP,data:{line:this._findAroundLineNumber()}};parent.postMessage(E,"*")}else this._throwAnErrorToStopPen()}catch(_){this._throwAnErrorToStopPen()}},_shouldPostMessage:function(){return document.location.href.match(/boomboom/)},_throwAnErrorToStopPen:function(){throw"We found an infinite loop in your Pen. We've stopped the Pen from running. More details and workarounds at https://blog.codepen.io/2016/06/08/can-adjust-infinite-loop-protection-timing/"},_findAroundLineNumber:function(){var E=new Error,_=0;if(E.stack){var o=E.stack.match(/boomboom\S+:(\d+):\d+/);o&&(_=o[1])}return _},_checkOnInfiniteLoop:function(E,_){if(!this._loopTimers[E])return this._loopTimers[E]=_,!1;var o;if(_-this._loopTimers[E]>this.MAX_TIME_IN_LOOP_WO_EXIT)throw"Infinite Loop found on loop: "+E},_getTime:function(){return+new Date}},window.CP.shouldStopExecution=function(E){var _=window.CP.PenTimer.shouldStopLoop(E);return!0===_&&console.warn("[CodePen]: An infinite loop (or a loop taking too long) was detected, so we stopped its execution. Sorry!"),_},window.CP.exitedLoop=function(E){window.CP.PenTimer.exitedLoop(E)};
        function mySearchFunction() {
            // Declare variables
            var input, filter, ul, li, item, i, txtValue;
            // User Input
            input = document.getElementById("myInput");
            // Filter, makes search not case sensitive
            filter = input.value.toUpperCase();
            // Grabs the parent element by id
            ul = document.getElementById("stateList");
            // Individual item on list
            li = ul.getElementsByTagName("li");

            // Treats lists items like an array, where each item can be accessed through      it's index
            for (i = 0; i < li.length; i++) {
                if (window.CP.shouldStopExecution(0)) break;
                item = li[i];
                // Iterate over each list item to see if the value of the input, ignoring         case, matches the inner text or inner html of the item.
                txtValue = item.textContent || item.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    // Displays list items that are a match, and nothing if no match
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            } window.CP.exitedLoop(0);
        }
        //# sourceURL=pen.js
    </script>
@stop
