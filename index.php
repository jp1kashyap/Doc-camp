<?php include 'includes/header-main.php'; ?>
<div x-data="sales">
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="javascript:;" class="text-primary hover:underline">Dashboard</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>MR</span>
        </li>
    </ul>

    <div class="pt-5">

        <div class="grid lg:grid-cols-2 grid-cols-1 gap-6">
            <div class="panel h-full w-full">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Recent Orders</h5>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th class="ltr:rounded-l-md rtl:rounded-r-md">Customer</th>
                                <th>Product</th>
                                <th>Invoice</th>
                                <th>Price</th>
                                <th class="ltr:rounded-r-md rtl:rounded-l-md">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-white-dark hover:text-black dark:hover:text-white-light/90 group">
                                <td class="min-w-[150px] text-black dark:text-white">
                                    <div class="flex items-center">
                                        <img class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover" src="<?=BASE_URL?>assets/images/profile-6.jpeg" alt="avatar" />
                                        <span class="whitespace-nowrap">Luke Ivory</span>
                                    </div>
                                </td>
                                <td class="text-primary">Headphone</td>
                                <td><a href="/apps/invoice/preview.php">#46894</a></td>
                                <td>$56.07</td>
                                <td><span class="badge bg-success shadow-md dark:group-hover:bg-transparent">Paid</span></td>
                            </tr>
                            <tr class="text-white-dark hover:text-black dark:hover:text-white-light/90 group">
                                <td class="text-black dark:text-white">
                                    <div class="flex items-center">
                                        <img class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover" src="<?=BASE_URL?>assets/images/profile-7.jpeg" alt="avatar" />
                                        <span class="whitespace-nowrap">Andy King</span>
                                    </div>
                                </td>
                                <td class="text-info">Nike Sport</td>
                                <td><a href="/apps/invoice/preview.php">#76894</a></td>
                                <td>$126.04</td>
                                <td><span class="badge bg-secondary shadow-md dark:group-hover:bg-transparent">Shipped</span></td>
                            </tr>
                            <tr class="text-white-dark hover:text-black dark:hover:text-white-light/90 group">
                                <td class="text-black dark:text-white">
                                    <div class="flex items-center">
                                        <img class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover" src="<?=BASE_URL?>assets/images/profile-8.jpeg" alt="avatar" />
                                        <span class="whitespace-nowrap">Laurie Fox</span>
                                    </div>
                                </td>
                                <td class="text-warning">Sunglasses</td>
                                <td><a href="/apps/invoice/preview.php">#66894</a></td>
                                <td>$56.07</td>
                                <td><span class="badge bg-success shadow-md dark:group-hover:bg-transparent">Paid</span></td>
                            </tr>
                            <tr class="text-white-dark hover:text-black dark:hover:text-white-light/90 group">
                                <td class="text-black dark:text-white">
                                    <div class="flex items-center">
                                        <img class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover" src="<?=BASE_URL?>assets/images/profile-9.jpeg" alt="avatar" />
                                        <span class="whitespace-nowrap">Ryan Collins</span>
                                    </div>
                                </td>
                                <td class="text-danger">Sport</td>
                                <td><a href="/apps/invoice/preview.php">#75844</a></td>
                                <td>$110.00</td>
                                <td><span class="badge bg-secondary shadow-md dark:group-hover:bg-transparent">Shipped</span></td>
                            </tr>
                            <tr class="text-white-dark hover:text-black dark:hover:text-white-light/90 group">
                                <td class="text-black dark:text-white">
                                    <div class="flex items-center">
                                        <img class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover" src="<?=BASE_URL?>assets/images/profile-10.jpeg" alt="avatar" />
                                        <span class="whitespace-nowrap">Irene Collins</span>
                                    </div>
                                </td>
                                <td class="text-secondary">Speakers</td>
                                <td><a href="/apps/invoice/preview.php">#46894</a></td>
                                <td>$56.07</td>
                                <td><span class="badge bg-success shadow-md dark:group-hover:bg-transparent">Paid</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel h-full w-full">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Top Selling Product</h5>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr class="border-b-0">
                                <th class="ltr:rounded-l-md rtl:rounded-r-md">Product</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Sold</th>
                                <th class="ltr:rounded-r-md rtl:rounded-l-md">Source</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-white-dark hover:text-black dark:hover:text-white-light/90 group">
                                <td class="min-w-[150px] text-black dark:text-white">
                                    <div class="flex"><img class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover" src="<?=BASE_URL?>assets/images/product-headphones.jpg" alt="avatar" />
                                        <p class="whitespace-nowrap">Headphone <span class="text-primary block text-xs">Digital</span></p>
                                    </div>
                                </td>
                                <td>$168.09</td>
                                <td>$60.09</td>
                                <td>170</td>
                                <td>
                                    <a class="text-danger flex items-center" href="javascript:;">
                                        <svg class="w-3.5 h-3.5 rtl:rotate-180 ltr:mr-1 rtl:ml-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.6644 5.47875L16.6367 9.00968C18.2053 10.404 18.9896 11.1012 18.9896 11.9993C18.9896 12.8975 18.2053 13.5946 16.6367 14.989L12.6644 18.5199C11.9484 19.1563 11.5903 19.4746 11.2952 19.342C11 19.2095 11 18.7305 11 17.7725V15.4279C7.4 15.4279 3.5 17.1422 2 19.9993C2 10.8565 7.33333 8.57075 11 8.57075V6.22616C11 5.26817 11 4.78917 11.2952 4.65662C11.5903 4.52407 11.9484 4.8423 12.6644 5.47875Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path opacity="0.5" d="M15.5386 4.5L20.7548 9.34362C21.5489 10.081 22.0001 11.1158 22.0001 12.1994C22.0001 13.3418 21.4989 14.4266 20.629 15.1671L15.5386 19.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        </svg>

                                        Direct
                                    </a>
                                </td>
                            </tr>
                            <tr class="text-white-dark hover:text-black dark:hover:text-white-light/90 group">
                                <td class="text-black dark:text-white">
                                    <div class="flex"><img class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover" src="<?=BASE_URL?>assets/images/product-shoes.jpg" alt="avatar" />
                                        <p class="whitespace-nowrap">Shoes <span class="text-warning block text-xs">Faishon</span></p>
                                    </div>
                                </td>
                                <td>$126.04</td>
                                <td>$47.09</td>
                                <td>130</td>
                                <td>
                                    <a class="text-success flex items-center" href="javascript:;">
                                        <svg class="w-3.5 h-3.5 rtl:rotate-180 ltr:mr-1 rtl:ml-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.6644 5.47875L16.6367 9.00968C18.2053 10.404 18.9896 11.1012 18.9896 11.9993C18.9896 12.8975 18.2053 13.5946 16.6367 14.989L12.6644 18.5199C11.9484 19.1563 11.5903 19.4746 11.2952 19.342C11 19.2095 11 18.7305 11 17.7725V15.4279C7.4 15.4279 3.5 17.1422 2 19.9993C2 10.8565 7.33333 8.57075 11 8.57075V6.22616C11 5.26817 11 4.78917 11.2952 4.65662C11.5903 4.52407 11.9484 4.8423 12.6644 5.47875Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path opacity="0.5" d="M15.5386 4.5L20.7548 9.34362C21.5489 10.081 22.0001 11.1158 22.0001 12.1994C22.0001 13.3418 21.4989 14.4266 20.629 15.1671L15.5386 19.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                        Google
                                    </a>
                                </td>
                            </tr>
                            <tr class="text-white-dark hover:text-black dark:hover:text-white-light/90 group">
                                <td class="text-black dark:text-white">
                                    <div class="flex"><img class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover" src="<?=BASE_URL?>assets/images/product-watch.jpg" alt="avatar" />
                                        <p class="whitespace-nowrap">Watch <span class="text-danger block text-xs">Accessories</span></p>
                                    </div>
                                </td>
                                <td>$56.07</td>
                                <td>$20.00</td>
                                <td>66</td>
                                <td>
                                    <a class="text-warning flex items-center" href="javascript:;">
                                        <svg class="w-3.5 h-3.5 rtl:rotate-180 ltr:mr-1 rtl:ml-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.6644 5.47875L16.6367 9.00968C18.2053 10.404 18.9896 11.1012 18.9896 11.9993C18.9896 12.8975 18.2053 13.5946 16.6367 14.989L12.6644 18.5199C11.9484 19.1563 11.5903 19.4746 11.2952 19.342C11 19.2095 11 18.7305 11 17.7725V15.4279C7.4 15.4279 3.5 17.1422 2 19.9993C2 10.8565 7.33333 8.57075 11 8.57075V6.22616C11 5.26817 11 4.78917 11.2952 4.65662C11.5903 4.52407 11.9484 4.8423 12.6644 5.47875Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path opacity="0.5" d="M15.5386 4.5L20.7548 9.34362C21.5489 10.081 22.0001 11.1158 22.0001 12.1994C22.0001 13.3418 21.4989 14.4266 20.629 15.1671L15.5386 19.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                        Ads
                                    </a>
                                </td>
                            </tr>
                            <tr class="text-white-dark hover:text-black dark:hover:text-white-light/90 group">
                                <td class="text-black dark:text-white">
                                    <div class="flex"><img class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover" src="<?=BASE_URL?>assets/images/product-laptop.jpg" alt="avatar" />
                                        <p class="whitespace-nowrap">Laptop <span class="text-primary block text-xs">Digital</span></p>
                                    </div>
                                </td>
                                <td>$110.00</td>
                                <td>$33.00</td>
                                <td>35</td>
                                <td>
                                    <a class="text-secondary flex items-center" href="javascript:;">
                                        <svg class="w-3.5 h-3.5 rtl:rotate-180 ltr:mr-1 rtl:ml-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.6644 5.47875L16.6367 9.00968C18.2053 10.404 18.9896 11.1012 18.9896 11.9993C18.9896 12.8975 18.2053 13.5946 16.6367 14.989L12.6644 18.5199C11.9484 19.1563 11.5903 19.4746 11.2952 19.342C11 19.2095 11 18.7305 11 17.7725V15.4279C7.4 15.4279 3.5 17.1422 2 19.9993C2 10.8565 7.33333 8.57075 11 8.57075V6.22616C11 5.26817 11 4.78917 11.2952 4.65662C11.5903 4.52407 11.9484 4.8423 12.6644 5.47875Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path opacity="0.5" d="M15.5386 4.5L20.7548 9.34362C21.5489 10.081 22.0001 11.1158 22.0001 12.1994C22.0001 13.3418 21.4989 14.4266 20.629 15.1671L15.5386 19.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                        Email
                                    </a>
                                </td>
                            </tr>
                            <tr class="text-white-dark hover:text-black dark:hover:text-white-light/90 group">
                                <td class="text-black dark:text-white">
                                    <div class="flex"><img class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover" src="<?=BASE_URL?>assets/images/product-camera.jpg" alt="avatar" />
                                        <p class="whitespace-nowrap">Camera <span class="text-primary block text-xs">Digital</span></p>
                                    </div>
                                </td>
                                <td>$56.07</td>
                                <td>$26.04</td>
                                <td>30</td>
                                <td>
                                    <a class="text-primary flex items-center" href="javascript:;">
                                        <svg class="w-3.5 h-3.5 rtl:rotate-180 ltr:mr-1 rtl:ml-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.6644 5.47875L16.6367 9.00968C18.2053 10.404 18.9896 11.1012 18.9896 11.9993C18.9896 12.8975 18.2053 13.5946 16.6367 14.989L12.6644 18.5199C11.9484 19.1563 11.5903 19.4746 11.2952 19.342C11 19.2095 11 18.7305 11 17.7725V15.4279C7.4 15.4279 3.5 17.1422 2 19.9993C2 10.8565 7.33333 8.57075 11 8.57075V6.22616C11 5.26817 11 4.78917 11.2952 4.65662C11.5903 4.52407 11.9484 4.8423 12.6644 5.47875Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path opacity="0.5" d="M15.5386 4.5L20.7548 9.34362C21.5489 10.081 22.0001 11.1158 22.0001 12.1994C22.0001 13.3418 21.4989 14.4266 20.629 15.1671L15.5386 19.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                        Referral
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer-main.php'; ?>
