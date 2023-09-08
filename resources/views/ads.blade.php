@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">  
                <form  method="POST" action="{{ route('ad.search') }}" onsubmit="search(event)"  id="searchForm">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" id="words" placeholder="Titre">
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                        
                    </div>
                </form>     
            <hr>
    <div class="row"  id="results">
        
        @foreach ( $ads as $ad )
         
            <div class="col-sm-6">
                <div class="card mb-3" style="width: 100%;">
                    
                        <div  id="carouselExampleControls-{{$ad->id}}" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" style="width:100%" >
                                @foreach(json_decode($ad->imageFile) as $picture) 
                              <div class="carousel-item @if($loop->first) active @endif">
                                <img class="card-img-top"  src="{{asset('/images/'.$picture)}}" alt="First slide">
                              </div>
                             @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls-{{$ad->id}}" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls-{{$ad->id}}" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                          </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $ad->title }}</h5>
                            <small>{{ Carbon\Carbon::parse($ad->created_at )->diffForHumans()}}</small>
                            <p class="card-text text-info">{{ $ad->localisation }}</p>
                            <p class="card-text">{{ $ad->description }}</p>
                            <p class="card-text">{{ $ad->price }}€</p>
                            <a href="#" class="card-link">Voir l'annonce</a>
                            <a href="{{ route('message.create',['seller_id'=> $ad->user_id, 'ad_id' => $ad->id ]  )}}" class="card-link">Contacter le vendeur</a>
                        </div>
                </div>
            </div>
          
    @endforeach
    {{ $ads->links() }}
       </div> 
     </div>
    </div>
</div>


@endsection

@section('extra-js')
    <script>
        function search(event) {
            
            event.preventDefault();
            const words = document.querySelector('#words').value;
            const url = document.querySelector('#searchForm').getAttribute('action');
            axios.post(`${url}`,{words:words,})
            .then(function (response) {
                const ads = response.data.ads;
                let results = document.querySelector('#results');
                results.innerHTML = '';
                for(let i=0; i<ads.length; i++){
                    let image = document.createElement('img');
                        image.classList.add('card-img-top');
                        image.setAttribute('src', 'https://via.placeholder.com/350x250');
                    let divcard = document.createElement('div');
                        divcard.classList.add('card');
                    let card = document.createElement('div');
                        card.classList.add('col-sm-6','mb-3');
                    
                    let cardBody = document.createElement('div');
                        cardBody.classList.add('card-body');
                        
                    let price = document.createElement('p');
                        price.classList.add('card-text');
                        price.innerHTML = ads[i].price + '€';                    
                    let title = document.createElement('h5');
                        title.classList.add('card-title');
                        title.innerHTML = ads[i].title;     
                    let description = document.createElement('p');
                        description.classList.add('card-text');
                        description.innerHTML = ads[i].description;

                    let localisation = document.createElement('p');
                        localisation.classList.add('card-text','text-info');
                        localisation.innerHTML = ads[i].localisation;
                    // CARD body
                    card.appendChild(divcard);
                    divcard.appendChild(image);
                    cardBody.appendChild(title);
                    cardBody.appendChild(localisation);
                    cardBody.appendChild(description);
                    cardBody.appendChild(price);
                    divcard.appendChild(cardBody);
                    results.appendChild(card);
                }

            })
            .catch(function (error) {
                console.log(error);
            });


        }
        // document.getElementById('searchForm').addEventListener('submit', search);
    </script>
 <script>
     $(document).ready(function(){

        $('.carousel').carousel()
            
        });
 </script>
 
@endsection