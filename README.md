<h1>🍽️ Recipe Management App (Laravel + MongoDB)</h1>
  <p>A Laravel-based web application for managing and sharing recipes with full user authentication, CRUD operations, reviews, image uploads, and more. This app is built using Laravel with MongoDB as the backend database using the query builder.</p>

  <h2>Features</h2>

  <h3>Authentication</h3>
  <ul>
    <li>User registration and login/logout using sessions</li>
    <li>Custom authentication logic using Laravel’s Query Builder</li>
    <li>Middleware to protect routes and restrict unauthenticated access</li>
  </ul>

  <h3>Recipe Management</h3>
  <ul>
    <li>Create, read, update, and delete (CRUD) recipes</li>
    <li>Upload and store recipe images with validation</li>
    <li>Display recipes in a paginated format on the homepage</li>
    <li>Each recipe includes title, description, ingredients, and image</li>
  </ul>

  <h3>User Reviews</h3>
  <ul>
    <li>Logged-in users can leave reviews on recipes</li>
    <li>Each review includes a rating and comment</li>
    <li>Reviews are linked to users and recipes</li>
    <li>MongoDB collection used to manage reviews separately</li>
  </ul>

  <h3>User Module</h3>
  <ul>
    <li>Admin can manage (CRUD) user accounts</li>
    <li>Fields: name, email, and hashed password</li>
    <li>Passwords stored securely using bcrypt hashing</li>
  </ul>

  <h3>Password Management</h3>
  <ul>
    <li>Logged-in users can change their password</li>
    <li>Change password form includes: old password, new password, confirm password</li>
    <li>Validation checks ensure old password matches before updating</li>
  </ul>

  <h3>Utilities</h3>
  <ul>
    <li>Helper function <code>auth_user()</code> to easily access session user data in views and controllers</li>
    <li>Middleware for route protection</li>
    <li>Flash messages for success/error handling</li>
  </ul>

  <h2>Tech Stack</h2>
  <ul>
    <li><strong>Framework</strong>: Laravel</li>
    <li><strong>Database</strong>: MongoDB (via <code>jenssegers/laravel-mongodb</code> package)</li>
    <li><strong>Frontend</strong>: Blade templates, Bootstrap (optional)</li>
    <li><strong>Session</strong>: Laravel Session for user login tracking</li>
    <li><strong>Image Uploads</strong>: Laravel file system</li>
  </ul>

  <h2>Project Structure Highlights</h2>
  <ul>
    <li><code>routes/web.php</code> – All routes defined here</li>
    <li><code>app/Http/Controllers</code> – Controllers for Recipes, Users, Reviews</li>
    <li><code>resources/views</code> – Blade templates for frontend</li>
    <li><code>public/uploads</code> – Stores uploaded recipe images</li>
  </ul>

  <h2>Requirements</h2>
  <ul>
    <li>PHP 8+</li>
    <li>Composer</li>
    <li>Laravel 10+</li>
    <li>MongoDB server</li>
    <li>Node.js (optional for compiling assets)</li>
  </ul>

  <h2>Setup Instructions</h2>
  <pre><code>git clone https://github.com/your-username/recipe-app.git
cd recipe-app
composer install
cp .env.example .env
php artisan key:generate
</code></pre>

  <p>Configure your MongoDB connection in <code>.env</code>:</p>
  <pre><code>DB_CONNECTION=mongodb
DB_HOST=127.0.0.1
DB_PORT=27017
DB_DATABASE=your_db_name
</code></pre>

  <p>Serve the project:</p>
  <pre><code>php artisan serve</code></pre>

  <h2>Contributions</h2>
  <p>Feel free to fork this repository and improve the app. Pull requests are welcome!</p>

  <h2>License</h2>
  <p>This project is open-sourced under the <a href="LICENSE">MIT License</a>.</p>
