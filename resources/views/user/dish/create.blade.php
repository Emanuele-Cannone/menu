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
                <form id="form" action="{{route('dish.store')}}" method="post" enctype="multipart/form-data" action="/details">
                  @csrf
                  @method('POST')
    
                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="name">Inserisci nome</label>
                      <input type="text" class="form-control" id="name" name="name">
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="description">Inserisci descrizione</label>
                      <input type="text" class="form-control" id="description" name="description">
                    </div>
                  </div>
    
                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="available">Inserisci disponibilità</label>
                      <input type="checkbox" class="form-control" id="available" name="available">
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="promo">Inserisci promo</label>
                      <input type="checkbox" class="form-control" id="promo" name="promo">
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="price">Inserisci prezzo</label>
                      <input type="number" class="form-control" id="price" name="price">
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="take_away">Inserisci take away</label>
                      <input type="checkbox" class="form-control" id="take_away" name="take_away">
                    </div>
                  </div>


                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="type">Inserisci tipologia</label>
                      <select name="type" id="type">
                          @foreach ($types as $type)
                              <option value="{{ $type->id }}">{{ $type->name }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>  

                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="diet">Inserisci dieta</label>
                      <select name="diet" id="diet">
                          @foreach ($diets as $diet)
                              <option value="{{ $diet->id }}">{{ $diet->name }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>  

                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="conservation">Inserisci conservazione</label>
                      <select name="conservation" id="conservation">
                          @foreach ($conservations as $conservation)
                              <option value="{{ $conservation->id }}">{{ $conservation->name }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>  

                  <div class="form-group row">
                    <div class="col-md-12">    
                      @foreach ($intollerances as $intollerance)
                      <label for="{{ $intollerance->name }}">{{ $intollerance->name }}</label>
                      <input type="checkbox" name="{{ $intollerance->name }}" id="intollerance">
                      @endforeach
                      </select>
                    </div>
                  </div>    
                  

                  <div class="form-group row">
                    <div class="col-md-12">
                    <label for="images[]">Inserisci immagini del tuo piatto</label>
                    <input  type="file" class="form-control" name="images[]" placeholder="address" multiple>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-12">
                    <label for="video">Inserisci video del tuo piatto</label>
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
