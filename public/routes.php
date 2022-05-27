<?php
$router
->get('/', 'category/index',  'home')
->get('/category/[*:slug]-[i:id]', 'category/show', 'category')
->get('/blog/[*:slug]-[i:id]', 'post/show', 'post')
->get('/image', 'image', 'image')
->get('/e404', 'e404', 'e404')
->get('/recherche', 'search/search', 'search')
->match('/contact', 'contact', 'contact')
->get('/politique-de-confidentialite', 'RGPD', 'rgpd')
->get('/a-propos', 'about', 'about')
// === ADMIN ===
// === Posts ===
->get('/admin', 'admin/post/index',  'admin_posts')
->match('/admin/post/[i:id]', 'admin/post/edit', 'admin_post')
->post('/admin/post/[i:id]/[*:token]/delete', 'admin/post/delete', 'admin_post_delete')
->match('/admin/post/new', 'admin/post/new', 'admin_post_new')
->get('/admin/post/thumbnail/[i:id]/[*:token]/delete', 'admin/post/thumbnail_delete','post_thumbnail_delete')
->get('/admin/post/images/[i:id]/[*:token]/detach', 'admin/post/images_detach', 'post_images_detach')
->get('/admin/post/files/[i:id]/[*:token]/detach', 'admin/post/files_detach', 'post_files_detach')
->get('/admin/guide', 'admin/guide', 'admin_guide')
// === Category ===
->get('/admin/categories', 'admin/category/index',  'admin_categories')
->match('/admin/category/[i:id]', 'admin/category/edit', 'admin_category')
->post('/admin/category/[i:id]/delete/[*:token]', 'admin/category/delete', 'admin_category_delete')
->get('/admin/category/thumbnail[i:id]/[*:token]/delete', 'admin/category/thumbnail_delete','category_thumbnail_delete')
->match('/admin/category/new', 'admin/category/new', 'admin_category_new')
// === Image ===
->get('/admin/images', 'admin/image/index',  'admin_images')
->post('/admin/image/[i:id]/delete/[*:token]', 'admin/image/delete', 'admin_image_delete')
->post('/admin/image/[i:id]/[*:token]/detach', 'admin/image/detach', 'admin_image_detach')
->match('/admin/image/new', 'admin/image/new', 'admin_image_new')
// === File ===
->get('/admin/files', 'admin/file/index',  'admin_files')
->post('/admin/file/[i:id]/delete/[*:token]', 'admin/file/delete', 'admin_file_delete')
->match('/admin/file/new', 'admin/file/new', 'admin_file_new')
// === SECURITY ===
->match('/admin/security', 'admin/security/index', 'security')
// === misc ===
->match('/connection', 'auth/login', 'login')
->post('/deconnection/[*:token]', 'auth/logout', 'logout')
// === RUN ===
->run();
