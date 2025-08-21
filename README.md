# ![Lay Framework](https://raw.githubusercontent.com/pillardash/lay-core/refs/heads/stable/src/static/img/logo.png)

**Lay** - A Lite PHP Meta-Framework for Rapid Development

[![PHP Version](https://img.shields.io/badge/PHP-8.1%2B-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)
[![Framework Version](https://img.shields.io/badge/Version-0.x-orange.svg)](https://github.com/pillardash/lay)

Lay is a modern, lightweight PHP meta-framework designed to get your projects up and running quickly. Built with developer experience in mind, it provides a clean architecture with powerful features while maintaining simplicity.

## ✨ Key Features

- **🚀 Rapid Development** - Get started in minutes with sensible defaults
- **🏗️ Domain-Driven Architecture** - Organize your application by domains/modules
- **🔌 Built-in API Support** - RESTful APIs with automatic routing and rate limiting
- **📱 Modern Frontend Integration** - Built-in JavaScript utilities and asset management
- **🗄️ Database Agnostic** - Support for MySQL, PostgreSQL, and SQLite
- **🔒 Security First** - CORS, CSRF protection, and secure session management
- **⚡ Performance Optimized** - Asset compression, caching, and production optimizations
- **🎨 Flexible View System** - Clean templating with PHP or integrate your favorite frontend

## 🚀 Quick Start

### Installation

Create a new Lay project using Composer:

```bash
composer create-project pillardash/lay my-awesome-project
cd my-awesome-project
```

### Environment Setup

1. Copy the environment file and configure your settings:
```bash
cp .env.example .env
```

2. Edit `.env` to match your environment:
```env
# Set your environment
APP_ENV=DEVELOPMENT

# Database configuration (optional)
DB_DRIVER=mysql
DB_HOST=127.0.0.1
DB_USERNAME=root
DB_PASSWORD=your_password
DB_NAME=your_database
```

### Start Development Server

```bash
# Using PHP built-in server
php -S localhost:8000

# Or using your preferred local server (Apache, Nginx, etc.)
```

Visit `http://localhost:8000` and you'll see your Lay application running! 🎉

## 📁 Project Structure

```
my-project/
├── bricks/                 # Business logic layer
│   └── Business/
│       ├── Api/            # API hooks and logic
│       ├── Controller/     # Application controllers
│       ├── Model/          # Data models
│       ├── Request/        # Request validation classes
│       └── Resource/       # API resource transformers
├── utils/                  # Utility classes and helpers
├── web/                    # Web layer
│   ├── domains/           # Domain-specific code
│   │   ├── Api/           # API domain
│   │   └── Default/       # Default web domain
│   └── shared/            # Shared assets and resources
├── foundation.php         # Application bootstrap
├── index.php             # Application entry point
└── bob.config.json       # Build and deployment configuration
```

## 🏗️ Core Concepts

### Domains

Lay organizes applications into **domains** - self-contained modules that handle specific parts of your application:

````php
Domain::new()->create(
    id: "api-endpoint",
    builder: \Web\Api\Plaster::class,
    pattern: "api",
    type: DomainType::SPECIAL,
);

Domain::new()->create(
    id: "default",
    builder: \Web\Default\Plaster::class,
    pattern: "*",
    type: DomainType::REGULAR,
);
````


### Controllers

Controllers handle your application logic using traits for common functionality:

````php
class NewsletterSubController
{
    use IsSingleton, ControllerHelper;

    public function add(): array
    {
        $request = new SubNewsletterRequest();

        if ($request->error)
            return self::res_warning($request->error);

        // Your logic here...
        return self::res_success("Success message");
    }
}
````


### Models

Models extend `BaseModelHelper` for database operations:

````php
class NewsletterSub extends BaseModelHelper
{
    public static string $table = "newsletter_subs";

    protected function cast_schema(): void
    {
        $this->cast("options", "array");
    }
}
````


## 🔌 Building APIs

### API Hooks

Define your API endpoints using the hook system:

````php
class Hook extends ApiHooks
{
    protected function hooks(): void
    {
        $this
            ->post("subscribe-newsletter")->bind(fn() => NewsletterSubController::new()->add())
            ->get("list-subscribers/{page}")->bind(fn($page) => NewsletterSubController::new()->list((int) $page));
    }
}
````


### Request Validation

Create request classes for automatic validation:

````php
class SubNewsletterRequest extends RequestHelper
{
    protected function rules(): void
    {
        $this->vcm(['field' => 'name', 'required' => false ]);
        $this->vcm(['field' => 'email', 'is_email' => true ]);
    }
}
````

## 🎨 Frontend Development

Lay includes a minimal but powerful JavaScript library for frontend interactions:

```javascript
// Built-in DOM utilities
$id('my-element').innerHTML = 'Hello World';
$sel('.my-class').$class('add', 'active');

// AJAX made simple
$ajax({
    url: $lay.src.api + 'subscribe-newsletter',
    method: 'POST',
    data: { email: 'user@example.com' },
}).then(response => {
    console.log('Success!', response);
    osNote("Success", "success")
});
```

## 🗄️ Database Integration

Enable database connection in your `foundation.php`:

````php
Startup::new()
    ->name($site_name, "$site_name | Slogan Goes Here")
    ->connect_db()
    ->set_globals([
        "desc" => "Your project description"
    ]);
````


## 🚀 Deployment

Lay includes production optimizations:

- **Asset Compression** - Automatic JS/CSS minification
- **HTML Compression** - Reduced payload sizes
- **Caching** - Domain and asset caching
- **Security Headers** - Production-ready security configuration

Configure in your `.env`:
```env
APP_ENV=PRODUCTION
COMPRESS_HTML=true
COMPRESS_ASSETS=true
CACHE_DOMAINS=true
```

## 📚 Learning Resources

- **Official Documentation**: [https://lay.pillardash.com](https://lay.pillardash.com) *(Coming Soon)*
- **Example Applications**: Check the `web/domains/Default` folder for examples
- **Community**: Join our discussions and get help from the community

## 🤝 Contributing

We welcome contributions! Please feel free to submit issues, feature requests, or pull requests.

## 📄 License

Lay is open-source software licensed under the [MIT License](LICENSE).

---

**Ready to build something amazing?** 🚀

```bash
composer create-project pillardash/lay my-next-project
```
