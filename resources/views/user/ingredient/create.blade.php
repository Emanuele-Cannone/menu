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
                Nuovo ingrediente
              </div>
              <div class="card-body">
                {{-- form --}}
                <form id="form" action="{{route('ingredient.store')}}" method="post" enctype="multipart/form-data">
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
                      <label for="availability">Inserisci disponibilità</label>
                      <input type="checkbox" class="form-control" id="availability" name="availability">
                    </div>
                  </div>
    
                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="conservation">Inserisci tipologia di conservazione</label>
                      <select name="conservation" id="conservation">
                          @foreach ($conservations as $conservation)
                              <option value="{{ $conservation->id }}">{{ $conservation->name }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>  
                  
                  <div class="form-group row">
                    <div class="col-md-12">
                        @foreach ($diets as $diet)
                        <label for="diet">{{ $diet->name }}</label>
                      
                          <input type="checkbox" class="form-control" id="diet" name="{{ $diet->name }}" value="{{ $diet->id }}">
                          @endforeach
              
                    </div>
                  </div>  

                  <div class="form-group row">
                    <div class="col-md-12">
                        @foreach ($intollerances as $intollerance)
                        <label for="intollerance">{{ $intollerance->name }}</label>
                      
                          <input type="checkbox" class="form-control" id="intollerance" name="{{ $intollerance->name }}" value="{{ $intollerance->id }}">
                          @endforeach
              
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
