<div class="card card-{{$bg}}
{{$outline ? 'card-outline' : ''}}
{{$collapsed ? 'collapsed-card' : ''}}
{{$full ? 'bg-'.$bg : ''}} ">

    @php
    @endphp

    @if ($cardHeaderView)

        <div class="card-header def_card_header" data-card-widget="{{$collapsedStyle}}">
            <h3 class="card-title {{$titleColor}} font-weight-normal ">{{$title}}</h3>
            <div class="card-tools">
                @if($collapsed)
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                    @if($removable)
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                        </button>
                    @endif
                    @if($maximizable)
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                        </button>
                    @endif
                @else
                    @if($addButtonRoute != '#')
                        <a href="{{$addButtonRoute}}" class="btn btn-sm btn-primary">{{$addButtonName}}</a>
                    @endif

                    @if($showIcon)
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    @endif

                   @if($removable)
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                        </button>
                    @endif
                    @if($maximizable)
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                        </button>
                    @endif
                @endif
            </div>
        </div>
    @endif

    <div class="card-body">
        @if($errors->has([]) and $addFormError == true)
            <div class="alert alert-danger alert-dismissible">
                {{__('general.alertMass.formHasError')}}
            </div>
        @endif
        {{$slot}}
    </div>

    @if($disabled)
        <div class="overlay dark">
            <i class="fas fa-2x fa-ban"></i>
        </div>
    @endif
</div>
