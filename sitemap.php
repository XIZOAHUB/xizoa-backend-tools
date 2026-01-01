<?php
// Is file ko apne root folder me 'sitemap.php' naam se save karein
header("Content-Type: application/xml; charset=utf-8");

// Base URL set karein
$baseUrl = "https://tools.xizoa.com";

// In files/folders ko sitemap me nahi dikhana hai
$ignore = array('.', '..', 'sitemap.php', 'robots.txt', '.htaccess', 'error_log', 'cgi-bin', 'css', 'js', 'images', 'includes', 'fonts');

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

// Current directory ke saare files scan karega
$files = scandir('.');

// Pehle Home Page add karte hain
echo "
   <url>
      <loc>{$baseUrl}/</loc>
      <lastmod>" . date('Y-m-d') . "</lastmod>
      <changefreq>daily</changefreq>
      <priority>1.0</priority>
   </url>";

foreach($files as $file) {
    // Agar ye folder hai aur ignore list me nahi hai (Tools folders)
    if(is_dir($file) && !in_array($file, $ignore)) {
        echo "
   <url>
      <loc>{$baseUrl}/{$file}/</loc>
      <lastmod>" . date('Y-m-d') . "</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.8</priority>
   </url>";
    }
    // Agar ye HTML/PHP file hai (Single page tools)
    elseif(!in_array($file, $ignore) && (pathinfo($file, PATHINFO_EXTENSION) == 'html' || pathinfo($file, PATHINFO_EXTENSION) == 'php')) {
        if($file != 'index.php' && $file != 'index.html') {
             echo "
   <url>
      <loc>{$baseUrl}/{$file}</loc>
      <lastmod>" . date('Y-m-d') . "</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.8</priority>
   </url>";
        }
    }
}

echo '</urlset>';
?>
