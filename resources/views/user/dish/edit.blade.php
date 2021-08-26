<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div id="create">
      <div class="container">
        <div class="row justify-content-center">
    
          <div class="col-md-8 col-lg-6">
            <div class="card">
              <div class="card-header text-center font-weight-bold">
                Nuovo piatto
              </div>
              <div class="card-body">
                {{-- form --}}
                <form id="form" action="{{route('dish.update', $dish)}}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
    
                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="name">Inserisci nome</label>
                      <input type="text" class="form-control" id="name" name="name" value="{{ $dish->name }}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="description">Inserisci descrizione</label>
                      <input type="text" class="form-control" id="description" name="description" value="{{ $dish->description }}">
                    </div>
                  </div>
    
                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="available">Inserisci disponibilità</label>
                      <input type="checkbox" class="form-control" id="available" name="available" <?php echo ($dish->available) ? 'checked' : '' ?>>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="promo">Inserisci promo</label>
                      <input type="checkbox" class="form-control" id="promo" name="promo" <?php echo ($dish->promo) ? 'checked' : '' ?>>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="price">Inserisci prezzo</label>
                      <input type="number" class="form-control" id="price" name="price" value="{{ $dish->price }}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="major_price">Inserisci maggiorazione</label>
                      <input type="text" class="form-control" id="major_price" name="major_price" value="{{ $dish->major_price }}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="take_away">Inserisci take away</label>
                      <input type="checkbox" class="form-control" id="take_away" name="take_away" <?php echo ($dish->take_away) ? 'checked' : '' ?>>
                    </div>
                  </div>
    


                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="type">Inserisci tipologia</label>
                      <select name="type" id="type">
                          @foreach ($types as $type)
                              <option value="{{ $type->id }}" <?php echo ($type->id == $dish->type_id) ? 'selected' : '' ?>>{{ $type->name }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>  


                  <div class="form-group row">
                    <div class="col-md-12">    
                      @foreach ($intollerances as $intollerance)
                      <label for="{{ $intollerance->name }}">{{ $intollerance->name }}</label>
                      <input type="checkbox" name="{{ $intollerance->name }}" id="intollerance"
                      @if ($intollerance->id == $dish->intollerance_id)
                              echo 'checked'
                          
                      @endif
                      >
                      @endforeach
                      </select>
                    </div>
                  </div>  



                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="diet">Inserisci dieta</label>
                      <select name="diet" id="diet">
                          @foreach ($diets as $diet)
                              <option value="{{ $diet->id }}"<?php echo ($diet->id == $dish->diet_id) ? 'selected' : '' ?>>{{ $diet->name }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>  

                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="conservation">Inserisci conservationa</label>
                      <select name="conservation" id="conservation">
                          @foreach ($conservations as $conservation)
                              <option value="{{ $conservation->id }}"<?php echo ($conservation->id == $dish->conservation_id) ? 'selected' : '' ?>>{{ $conservation->name }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>  


                  <div class="form-group row">
                    <div class="col-md-12">
                    <label for="images[]">
                      @if ($images)
                        Modifica le immagini      
                      @else
                        Inserisci immagini del tuo appartamento
                      @endif
                    </label>    
                    <input type="file" class="form-control" name="images[]" placeholder="address" multiple>
                    </div>
                  </div>

                  @if ($images)
                     
                    @foreach ($images as $k => $image)
                        <img src="" alt="{{ $k }}" style="height: 100px;">
                        <input type="checkbox" name="img{{ $k }}">
                    @endforeach

                  @endif

                  
                  
                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="video">
                        
                        @if ($dish->video)
                        Modifica il video del tuo piatto
                        <input type="checkbox" name="video_altro">
                        @else
                        Inserisci video del tuo piatto
                        @endif
                        </label>
                    <input  type="file" class="form-control" name="video" placeholder="address" >
                    </div>
                  </div>
                  
    
                    <button type="submit" class="btn btn-primary">Salva</button>
    
                  </form>
              </div>
            </div>
          </div>
    
          {{-- validation --}}
          @if ($errors->any())
            <div class="col-12 d-flex justify-content-center row">
              <div class="alert alert-danger col-md-8 col-lg-6">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            </div>
          @endif
    
        </div>
      </div>
    
    </div>
</body>
</html>
