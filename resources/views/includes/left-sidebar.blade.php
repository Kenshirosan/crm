<div class="column is-parent is-2">
    <aside class="menu is-child">
        <p class="menu-label">
            General
        </p>
        @can('edit_user')
            <ul class="menu-list">
                <li><router-link exact to="/">Home Page</router-link></li>
                <li><router-link exact to="/create/address">Create an address</router-link></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
            </ul>
            <ul class="menu-list">
                <li><a>Dashboard</a></li>
                <li><a>Customers</a></li>
            </ul>
            <p class="menu-label">
                Administration
            </p>
            <ul class="menu-list">
                <li><a>Team Settings</a></li>
                <li>
                    <a class="is-active">Manage Your Team</a>
                    <ul>
                        <li><a>Members</a></li>
                        <li><a>Plugins</a></li>
                        <li><a>Add a member</a></li>
                    </ul>
                </li>
                <li><a>Invitations</a></li>
                <li><a>Cloud Storage Environment Settings</a></li>
                <li><a>Authentication</a></li>
            </ul>
            <p class="menu-label">
                Transactions
            </p>
            <ul class="menu-list">
                <li><a>Payments</a></li>
                <li><a>Transfers</a></li>
                <li><a>Balance</a></li>
            </ul>
        @else
            <ul class="menu-list">
                <li><router-link to="/" exact>Login</router-link></li>
            </ul>
        @endcan
    </aside>


</div>
