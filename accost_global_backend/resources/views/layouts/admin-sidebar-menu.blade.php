<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item">
                    <a href="{{ route('admin-dashboard') }}" id="menu-item-dashboard">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#sb_catalog" id="menu-item-catalog">
                        <i class="fas fa-cube"></i>
                        <p>Catalog</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sb_catalog">
                        <ul class="nav nav-collapse">
                            <li class="sub_list">
                                <a data-toggle="collapse" href="#super_category" id="menu-item-super-category">
                                    <i class="fas fa-align-justify"></i>
                                    <span class="sub-item" style="margin-left: 0px !important;">Super Categories</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="super_category">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="{{ route('newSuperCategory') }}">
                                                <span class="sub-item">Add New</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('listSuperCategory') }}">
                                                <span class="sub-item">List View</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="sub_list">
                                <a data-toggle="collapse" href="#sb_product_categories" id="menu-item-product-category">
                                    <i class="fas fa-align-left"></i>
                                    <span class="sub-item" style="margin-left: 0px !important;">Categories</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="sb_product_categories">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="{{ route('get-new-pro-category') }}">
                                                <span class="sub-item">Add New</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('pro-category') }}">
                                                <span class="sub-item">List View</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="sub_list">
                                <a data-toggle="collapse" href="#sb_product_subcategories" id="menu-item-sub-category">
                                    <i class="fas fa-align-center"></i>
                                    <span class="sub-item" style="margin-left: 0px !important;">Subcategories</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="sb_product_subcategories">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="{{ route('new-pro-subcat') }}">
                                                <span class="sub-item">Add New</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('list-pro-subcat') }}">
                                                <span class="sub-item">List View</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="brand_list">
                                <a data-toggle="collapse" href="#brand_manager" id="menu-item-brand">
                                    <i class="fas fa-bold"></i>
                                    <span class="brand">Brand Manager</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="brand_manager">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="{{ route('add-brand') }}">
                                                <span class="sub-item">Add New</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('list-brand') }}">
                                                <span class="sub-item">List View</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="sub_list">
                                <a data-toggle="collapse" href="#sub_products" id="menu-item-products">
                                    <i class="fab fa-product-hunt"></i>
                                    <span class="sub-item" style="margin-left: 0px !important;">Products</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="sub_products">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="{{ route('new-product') }}">
                                                <span class="sub-item">Add New</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('product-list') }}">
                                                <span class="sub-item">List View</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('product-stock') }}">
                                                <span class="sub-item">Stocks</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="sub_list">
                                <a data-toggle="collapse" href="#sub_highlights" id="menu-item-highlights">
                                    <i class="fas fa-highlighter"></i>
                                    <span class="sub-item" style="margin-left: 0px !important;">Highlight Attributes</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="sub_highlights">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="{{ route('new-highlight') }}">
                                                <span class="sub-item">Add New</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('list-highlight') }}">
                                                <span class="sub-item">List View</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('list-messages') }}" id="menu-item-message">
                        <i class="far fa-envelope"></i>
                        <p>Messages</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('messages-notification')}}" id="menu-item-message">
                        <i class="fa fa-bell"></i>
                        <p>Notifications</p>
                        @if($msg_notification_count1>0)
                        <span class="badge badge-success notification_count">{{$msg_notification_count1}}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#sb_manages_pages" class="collapsed" aria-expanded="false" id="menu-item-pages-banners">
                        <i class="fas fa-book-open"></i>
                        <p>Manage Pages & Banners</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sb_manages_pages">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('list-pages') }}">
                                    <span class="sub-item">Static Pages</span>
                                </a>
                                <a data-toggle="collapse" href="#home_banner" id="menu-item-home-banners">
                                    <span class="sub-item">Home Banners</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="home_banner">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="{{ route('new-home-banner') }}">
                                                <span class="sub-item">Add New</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('list-home-banner') }}">
                                                <span class="sub-item">List View</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <a data-toggle="collapse" href="#manage-faq" id="menu-item-manage-faq">
                                    <span class="sub-item">Faq Page</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="manage-faq">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="{{ route('add-faq-pages') }}">
                                                <span class="sub-item">Add New</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('list-faq-pages') }}">
                                                <span class="sub-item">List View</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                {{--<a data-toggle="collapse" href="#home_page" id="menu-item-home-banners">
                                    <span class="sub-item">HomePage</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="home_page">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="{{ route('list-top-categories') }}">
                                                <span class="sub-item">Top Categories</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('list-top-deals') }}">
                                                <span class="sub-item">Top Deals</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('list-top-ranked-products') }}">
                                                <span class="sub-item">Top Ranked Products</span>
                                            </a>
                                        </li>                                        
                                    </ul>
                                </div>--}}
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#manage_dealers" class="collapsed" aria-expanded="false" id="menu-item-dealers">
                        <i class="fas fa-address-card"></i>
                        <p>Manage Dealers</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="manage_dealers">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('add-dealer') }}">
                                    <span class="sub-item">Add New</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('list-dealer') }}">
                                    <span class="sub-item">List View</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#manage_taxes" class="collapsed" aria-expanded="false" id="menu-item-taxes">
                        <i class="fas fa-hand-holding-usd"></i>
                        <p>Manage Taxes</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="manage_taxes">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('list-product-type') }}">
                                    <span class="sub-item">Product Types</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('list-taxes') }}">
                                    <span class="sub-item">Taxes</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#discount" class="collapsed" aria-expanded="false" id="menu-item-coupon">
                        <i class="fas fa-tags"></i>
                        <p>Discount & Promotion</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="discount">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('new-coupons') }}">
                                    <span class="sub-item">Add New</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('list-coupons') }}">
                                    <span class="sub-item">List View</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
