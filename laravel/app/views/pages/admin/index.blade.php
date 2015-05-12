@extends('.........layouts.game')

@section('content')

    {{ Fickle::openPanel('Administration area', 12) }}

         <div class="row">
             <a href="/admin/users">
                 <div class="col-md-3 col-sm-3 col-xs-6">
                     <div class="ls-circle-widget label-light-green white">
                         <i class="fa fa-users"></i>
                         <h1>Manage users</h1>
                     </div>
                 </div>
             </a>
             <a href="/admin/stocks">
                 <div class="col-md-3 col-sm-3 col-xs-6">
                     <div class="ls-circle-widget label-red white">
                         <i class="fa fa-line-chart"></i>

                         <h1>Manage stocks</h1>
                     </div>
                 </div>
             </a>
             <div class="col-md-3 col-sm-3 col-xs-6">

             </div>
             <div class="col-md-3 col-sm-3 col-xs-6">

             </div>
         </div>

    {{ Fickle::closePanel() }}

@endsection