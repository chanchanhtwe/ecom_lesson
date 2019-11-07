<div class="accordion d-none d-sm-block" id="accordionExample">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h2 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-user-alt"></i> {{ Auth::User()->name }} <i class="fas fa-caret-down"></i>
                </button>
            </h2>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="{{route('dashboard')}}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <i class="fas fa-tags"></i> Posts <i class="fas fa-caret-down"></i>
                </button>
            </h2>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="{{route('orders')}}"><i class="fas fa-first-order-alt"></i> Orders</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('posts.categories')}}"><i class="fas fa-clipboard-list"></i> Categories</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('new.post')}}"><i class="fas fa-plus-square"></i> Add Post </a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('posts')}}"><i class="fas fa-tags"></i> All Posts </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingThree">
            <h2 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                   <i class="fas fa-users-cog"></i> Setting <i class="fas fa-caret-down"></i>
                </button>
            </h2>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="{{route('users')}}"><i class="fas fa-users"></i> Users </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>