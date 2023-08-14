<div class="card">
    <div class="card-header border-0 bg-primary">
        <h3 class="card-title">{{ $name }}</h3>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle">
            <tbody>

            <tr>
                <td>لا توجد صورة </td>
                <td>{{ $cardCount['noPhoto'] }}  {{$lable}} </td>
                <td><a href="{{route($url.'.noPhoto')}}" class="text-muted"><i class="fas fa-search"></i></a></td>
            </tr>

            <tr>
                <td>رابط مكرر </td>
                <td>{{ $cardCount['slugErr'] }} {{$lable}} </td>
                <td><a href="{{route($url.'.slugErr')}}" class="text-muted"><i class="fas fa-search"></i></a></td>
            </tr>

            <tr>
                <td>لا يوجد محتوى عربى </td>
                <td>{{ $cardCount['noAr'] }} {{$lable}} </td>
                <td><a href="{{route($url.'.noAr')}}" class="text-muted"><i class="fas fa-search"></i></a></td>
            </tr>

            <tr>
                <td>لا يوجد محتوى انجليزى</td>
                <td>{{ $cardCount['noEn'] }}  {{$lable}} </td>
                <td><a href="{{route('post.noEn')}}" class="text-muted"><i class="fas fa-search"></i></a></td>
            </tr>

            <tr>
                <td>غير مفعل </td>
                <td>{{ $cardCount['unActive'] }} {{$lable}}  </td>
                <td><a href="{{route('post.unActive')}}" class="text-muted"><i class="fas fa-search"></i></a></td>
            </tr>

            </tbody>
        </table>
    </div>
</div>
