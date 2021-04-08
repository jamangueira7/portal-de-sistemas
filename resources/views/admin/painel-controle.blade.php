@extends('template.master')
@section('conteudo-view')
<div class="container-lg mt-5">
	<div class="row">
    <div class="accordion" id="accordionExample">
      <div class="col-3 pt-4">
        <div class="card">
          <div class="card-header" id="headingOne">            
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Portal 1
            </button>           
          </div>          
        </div>
        <div class="card">
          <div class="card-header" id="headingTwo">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Collapsible Group Item #2
            </button>
          </div>
        </div> 
      </div>
      <div class="col-9">
        <div class="conteudo-acordeon-direito accordion" id="accordionExample1">
          <div id="collapseOne" class="item-colapse collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <div class="card-header" id="headingOne1">
                    
                    <div type="button" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1">
                      Portal 1 - item 1
                    </div>
                   
                  </div>
                  <div id="collapseOne1" class="collapse" aria-labelledby="headingOne1" data-parent="#accordionExample1">
                    <div class="card-body">                      
                        <p>Portal 1 - item 1 - URL</p>
                        <input type="text" name="URL"/>                                          
                      <div class="cont-check">
                        <p>Portal 1 - item 1 - GRUPO PERMISSAO</p> 
                        <div class="item-check">
                          <label class="label-nome">Grupo 1
                            <input type="checkbox">
                            <span class="checkmark"></span>
                          </label>
                          <label class="label-nome">Grupo 2
                            <input type="checkbox">
                            <span class="checkmark"></span>
                          </label>
                        </div>
                      </div>
                      

                    </div>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Portal 1 - item 2</a>
                </li>              
              </ul>
            </div>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
              2 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
            </div>
          </div>        
        </div>

        
      </div>
    </div>
	</div>
</div>

@stop

