<?php
$router
->get('/', 'category/index',  'home')
->get('/category/[*:slug]-[i:id]', 'category/show', 'category')
->get('/blog/[*:slug]-[i:id]', 'post/show', 'post')
->match('/login', 'auth/login', 'login')
->post('/logout', 'auth/logout', 'logout')
// ADMIN
// Posts
->get('/admin', 'admin/post/index',  'admin_posts')
->match('/admin/post/[i:id]', 'admin/post/edit', 'admin_post')
->post('/admin/post/[i:id]/delete', 'admin/post/delete', 'admin_post_delete')
->match('/admin/post/new', 'admin/post/new', 'admin_post_new')
    ->get('/admin/guide', 'admin/post/guide', 'admin_guide')
// Category
->get('/admin/categories', 'admin/category/index',  'admin_categories')
->match('/admin/category/[i:id]', 'admin/category/edit', 'admin_category')
->post('/admin/category/[i:id]/delete', 'admin/category/delete', 'admin_category_delete')
->match('/admin/category/new', 'admin/category/new', 'admin_category_new')
// SECURITY
->match('/admin/security', 'admin/security/index', 'security')
->run();
