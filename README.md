# WHOIS 查询工具

一个基于 PHP 的 WHOIS 查询工具，提供网页界面和 API 接口，方便用户查询域名 WHOIS 信息。



## 特性

- **网页界面**: 提供一个简单直观的网页表单，用户可以输入域名进行 WHOIS 查询。
- **API 接口**: 提供一个 RESTful API 接口，方便开发者集成 WHOIS 查询功能到自己的应用程序中。
- **自动识别 TLD**: 能够根据输入的域名自动识别TLD（可以是二级）并选择相应的 WHOIS 服务器。
- **可配置的 WHOIS 服务器**: 通过 `config/whois_servers.php` 文件，可以轻松修改 WHOIS 服务器和支持查询的 TLD 。
- **错误处理**: 完善的错误处理机制，能够捕获并显示查询过程中发生的异常。



## 安装

### 先决条件

- PHP 7.4 或更高版本
- Apache Web 服务器

### 步骤

1. 将项目文件下载到您的 Web 服务器目录中。

2. 设置 `public/` 目录为运行目录。

3. （可选） 如果您需要自定义 WHOIS 服务器和支持查询的 TLD ，请编辑 `config/whois_servers.php` 文件。

4. （可选）你可以选择启用或禁用 `public/.htaccess` 文件中的部分功能



## 使用

### 网页界面

访问 `http://your-domain.com` 即可使用网页界面进行 WHOIS 查询。在输入框中输入您想要查询的域名，然后点击“查询”按钮。

### API 接口

WHOIS 查询 API 支持 `GET` 和 `POST` 请求。

**请求 URL:**

```
http://your-domain.com/api
```

**请求方法:**

`GET` 或 `POST`

**参数:**

| 参数名 | 类型   | 描述     | 必填 |
| ------ | ------ | -------- | ---- |
| `domain` | `string` | 要查询的域名 | 是   |

**示例 (GET):**

```
curl http://your-domain.com/api/example.com
```

**示例 (POST):**

```
curl -X POST https://mydomain.com/api/test.com
```

**成功响应:**

```json
{
  "domain": "example.com",
  "whois": "... WHOIS 查询结果 ..."
}
```

**错误响应:**

```json
{
  "error": "错误信息"
}
```



## 项目结构

```
自建域名Whois查询系统V3/
├── config/
│   └── whois_servers.php  # WHOIS 服务器和支持查询的 TLD 配置
├── public/
│   ├── assets/
│   │   └── style.css      # 样式文件
│   ├── api.php            # API 接口文件
│   └── index.php          # 网页界面文件
└── src/
    ├── WhoisClient.php    # WHOIS 客户端核心逻辑
    └── WhoisServerMap.php # WHOIS 服务器映射
```



## 许可证

本项目采用 MIT 许可证。

```
MIT License

Copyright (c) [2025] [Mike Leone (Orgv.EU Team)]

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```



## 贡献

欢迎对本项目进行贡献！如果您有任何改进或新功能，请随时提交 Pull Request。在提交之前，请确保您的代码符合项目规范并已通过测试。

1. Fork 本仓库
2. 创建您的特性分支 (`git checkout -b feature/AmazingFeature`)
3. 提交您的更改 (`git commit -m 'Add some AmazingFeature'`)
4. 推送到分支 (`git push origin feature/AmazingFeature`)
5. 打开一个 Pull Request


