# EAP: Architecture Specification and Prototype

The Super Legit Collaborative News (SLCN) is a project headed by a small group of developers with the main goal of free, open, and accessible news sharing for and by users.

This will allow all users to view and browse all types of news and comments on any topic, with access to text search and tag selection.

## A7: Web Resources Specification

This artifact documents the architecture of the web application to be developed, indicating the catalog of resources, the properties of each resource, and the format of JSON responses. This specification adheres to the OpenAPI standard using YAML.

This artifact presents the documentation for SLCN (Super Legit Collaborative News), including the CRUD (create, read, update, delete) operations for each resource.

### 1. Overview


<table>
  <tr>
    <th>M01: Authentication</th>
    <td>
        Web resources associated with user authentication and individual profile management. Includes the following system features: login/logout, registration, password recovery, view and edit personal profile information.
    </td>
  </tr>
    <th>M02: Users</th>
    <td>
        Web resources associated with the interaction with other users. Includes the following: view and search user's profile and follow users.
    </td>
  </tr>
  <tr>
    <th>M03: News</th>
    <td> Web resources associated with news items. Includes the following system features: news list and search, creation, deletion, editing, voting and favoriting. </td>
  </tr>
  <tr>
    <th>M04: Comments</th>
    <td> Web resources associated with comments. Includes the folllowing system features: comment creation, deletion, editing and voting.</td>
  </tr>
  <tr>
    <th>M05: Tags</th>
    <td> Web resources associated with tags. Includes the folllowing system features: tag creation, search, deletion and following. </td>
  </tr>
  <tr>
    <th>M06: Notifications</th>
    <td>
        Web resources associated with notifications.
    </td>
  </tr>
    <tr>
    <th>M07: Reports</th>
    <td>Web resources associated with reports. Includes the folllowing system features: report creation and processing.</td>
  </tr>
  <tr>
    <th>M08: Search</th>
    <td>
        Web resources associated with searching user, news and comments.</td>
  </tr>
    <tr>
    <th>M09: User Administration and Static pages</th>
    <td>
        Web resources associated with user, news, comments, tags and reports specifically: view, search, delete or block information and details. Web resources with static content are associated with this module: about us, contact, services and faq.</td>
  </tr>
</table>


### 2. Permissions

<table>
  <tr>
    <th> PUB </th>
    <td>Public</td>
    <td>User without privileges</td>
  </tr>
  <tr>
    <th> USR </th>
    <td>User</td>
    <td>Authenticated users</td>
  </tr>
  <tr>
    <th>AUTH</th>
    <td>Author</td>
    <td>Users that are authors of the information (e.g. own profile, own news, own comments)</td>
  </tr>
  <tr>
    <th> ADM </th>
    <td>Administrator</td>
    <td>System administrators</td>
  </tr>
</table>

### 3. OpenAPI Specification

[a7_openapi.yaml](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2286/-/blob/main/a7_openapi.yaml)


```yaml
openapi: 3.0.0

info:
 version: '1.0'
 title: 'LBAW SLCN Web API'
 description: 'Web Resources Specification (A7) for SLCN'

servers:
- url: http://lbaw2286.lbaw.fe.up.pt
  description: Production server

externalDocs:
 description: Find more info here.
 url: https://git.fe.up.pt/lbaw/lbaw2223/lbaw2286/-/wikis/home

tags:
 - name: 'M01: Authentication'
 - name: 'M02: Users'
 - name: 'M03: News'
 - name: 'M04: Comments'
 - name: 'M05: Tags'
 - name: 'M06: Notifications'
 - name: 'M07: Reports'
 - name: 'M08: Search'
 - name: 'M09: User Administration and Static Pages'

paths:
     /login:
       get:
         operationId: R101
         summary: 'R101: Login Form'
         description: 'Provide login form. Access: PUB'
         tags:
           - 'M01: Authentication'
         responses:
           '200':
             description: 'Ok. Show Log-in UI10'
       post:
         operationId: R102
         summary: 'R102: Login Action'
         description: 'Processes the login form submission. Access: PUB'
         tags:
           - 'M01: Authentication'

         requestBody:
           required: true
           content:
             application/x-www-form-urlencoded:
               schema:
                 type: object
                 properties:
                   email:  # <!--- form field name
                     type: string
                   password: # <!--- form field name
                     type: string
                 required:
                      - email
                      - password

         responses:
           '302':
             description: 'Redirect after processing the login credentials.'
             headers:
               Location:
                 schema:
                   type: string
                 examples:
                   302Success:
                     description: 'Successful authentication. Redirect main page.'
                     value: '/'
                   302Error:
                     description: 'Failed authentication. Redirect to login form.'
                     value: '/login'

     /logout:
       post:
         operationId: R103
         summary: 'R103: Logout Action'
         description: 'Logout the current authenticated user. Access: USR, ADM'
         tags:
           - 'M01: Authentication'
         responses:
           '302':
             description: 'Redirect after processing logout.'
             headers:
               Location:
                 schema:
                   type: string
                 examples:
                   302Success:
                     description: 'Successful logout. Redirect to main page.'
                     value: '/'
                   302Failure:
                     description: 'Failed logout. Redirect to main page.'
                     value: '/'

     /register:
       get:
         operationId: R104
         summary: 'R104: Register Form'
         description: 'Provide new user registration form. Access: PUB'
         tags:
           - 'M01: Authentication'
         responses:
           '200':
             description: 'Ok. Show Sign-Up UI09'

       post:
         operationId: R105
         summary: 'R105: Register Action'
         description: 'Processes the new user registration form submission. Access: PUB'
         tags:
           - 'M01: Authentication'

         requestBody:
           required: true
           content:
             application/x-www-form-urlencoded:
               schema:
                 type: object
                 properties:
                   username:
                     type: string
                   email:
                     type: string
                   password:
                     type: string
                 required:
                          - username
                          - email
                          - password
         responses:
           '302':
             description: 'Redirect after processing the new user information.'
             headers:
               Location:
                 schema:
                   type: string
                 examples:
                   302Success:
                     description: 'Successful authentication. Redirect to main page.'
                     value: '/'
                   302Failure:
                     description: 'Failed authentication. Redirect to login form.'
                     value: '/login'
     /profile/{id}:
      get:
        operationId: R201
        summary: "R201: Gets a profile page of a user."
        description: "Displays profile page of a user. Access: USR"
        tags:
          - 'M02: Users'
        responses:
         '200':
           description: 'Ok. Show Profile page [UI03]'
         '302':
             description: 'Redirect.'
             headers:
               Location:
                 schema:
                   type: string
                 examples:
                   302Failure:
                     description: 'Redirect to login page.'
                     value: '/login'

     /edit_profile/{id}:
      post:
        operationId: R202
        summary: "R202: Displays User edit page."
        description: "Display edit page for a user's profile. Access: AUTH, ADM"
        tags:
          - 'M02: Users'
        requestBody:
           required: true
           content:
             application/x-www-form-urlencoded:
               schema:
                 type: object
                 properties:
                   id:
                     type: integer
                 required:
                          - id
        responses:
           '302':
             description: 'Redirect.'
             headers:
               Location:
                 schema:
                   type: string
                 examples:
                   302Success:
                     description: 'Redirect to profile edit page.'
                     value: '/edit_profile/{id}'
                   302Failure:
                     description: 'Redirect to profile page.'
                     value: '/profile/{id}'

     /api/edit_profile/{id}:
      post:
        operationId: R203
        summary: "R203: Edits a user's profile."
        description: "Processes and edits a user's profile. Access: AUTH, ADM"
        tags:
          - 'M02: Users'
        requestBody:
           required: true
           content:
             application/x-www-form-urlencoded:
               schema:
                 type: object
                 properties:
                   id:
                     type: integer
                   username:
                     type: string
                   country:
                     type: string
                   email:
                     type: string
                   password:
                     type: string
                 required:
                          - id
                          - username
                          - country
                          - email
                          - password
        responses:
           '302':
             description: 'Redirect.'
             headers:
               Location:
                 schema:
                   type: string
                 examples:
                   302Success:
                     description: 'Redirect to profile page.'
                     value: '/profile/{id}'
                   302Failure:
                     description: 'Redirect to profile edit page.'
                     value: '/edit_profile/{id}'

     /change_admin/{id}:
      post:
        operationId: R204
        summary: "R204: Changes a users admin role."
        description: "Changes a users admin role. If the user is an admin, they lose the role and vice-versa. Access: ADM"
        tags:
          - 'M02: Users'
        requestBody:
           required: true
           content:
             application/x-www-form-urlencoded:
               schema:
                 type: object
                 properties:
                   id:
                     type: integer
                 required:
                  - id
        responses:
           '302':
             description: 'Redirect.'
             headers:
               Location:
                 schema:
                   type: string
                 examples:
                   302Success:
                     description: 'Redirect to profile page.'
                     value: '/profile/{id}'
                   302Failure:
                     description: 'Redirect to profile page.'
                     value: '/profile/{id}'

     /:
      get:
        operationId: R301
        summary: 'R301: Shows home feed.'
        description: 'Obtains page with the most popular news items. Access; PUB'
        tags:
          - 'M03: News'
        responses:
          '200':
            description: 'Ok. Show home feed [UI01]'

     /news/{id}:
      get:
        operationId: R302
        summary: 'R302: Shows news item.'
        description: 'Obtains page with the selected news item. Access; USR'
        tags:
          - 'M03: News'
        parameters:
          - in: path
            name: id
            schema:
              type: integer
            required: true
        responses:
          '200':
            description: 'Ok. Show news item [UI02]'
          '302':
            description: 'User not logged in. Redirect to login form'
            headers:
              Location:
                schema:
                  type: string
                examples:
                  302Failure:
                    description: 'User not logged in. Redirect to login page.'
                    value: '/login'

     /api/news:
      post:
        operationId: R303
        summary: 'R303: News creation action.'
        description: 'Processes the new news item form submition and creates the news item. Access; USR'
        tags:
          - 'M03: News'
        requestBody:
          required: true
          content:
            application/x-www-form-urlenconded:
              schema:
                type: object
                properties:
                  title:
                    type: string
                  content:
                    type: string
                  picture:
                    type: object
                  id_author:
                    type: integer
                required:
                  - title
                  - content
                  - id_author

        responses:
          '302':
            description: 'Redirect after processing new news item.'
            headers:
              Location:
                schema:
                  type: string
                examples:
                  302Success:
                    description: 'Successful news creation. Redirection to news item.'
                    value: '/news/{id}'
                  302Failure:
                    description: 'Failure in news creation. Redirection to home page.'
                    value: '/'

     /api/news/{news_id}:
      post:
        operationId: R304
        summary: "R304: Deletes a news item"
        description: "Deletes a news item; Access: AUTH, ADM"
        tags:
          - 'M03: News'
        requestBody:
          required: true
          content:
            application/x-www-form-urlenconded:
              schema:
                type: object
                properties:
                  id:
                    type: integer
                required:
                  - id
        responses:
          '302':
            description: 'Redirect after processing and deleting news item.'
            headers:
              location:
                schema:
                  type: string
                examples:
                  302Sucess:
                    description: 'Successful news deletion. Redirection to home page.'
                    value: '/'
                  302Failure:
                    description: 'Failure in news deletion. Redirection to news page.'
                    value: '/news/{id}'

     /api/news/update/{news_id}:
      post:
        operationId: R305
        summary: "R305: Edits a news item"
        description: "Processes and edits a news item; Access: AUTH, ADM"
        tags:
          - 'M03: News'
        requestBody:
          required: true
          content:
            application/x-www-form-urlenconded:
              schema:
                type: object
                properties:
                  id:
                    type: integer
                  title:
                    type: string
                  content:
                    type: string
                  picture:
                    type: object
                  id_author:
                    type: integer
                required:
                  - id
                  - title
                  - content
                  - id_author
        responses:
          '302':
            description: 'Redirect after editing news item.'
            headers:
              location:
                schema:
                  type: string
                examples:
                  302Success:
                    description: 'Successful news update. Redirection to news page.'
                    value: '/news/{id}'
                  302Failure:
                    description: 'Failure in news update. Redirection to news page.'
                    value: '/news/{id}'
     /search:
       get:
        operationId: R801
        summary: 'R801: Search for news posts or users'
        description: 'Search for news posts or users. Access: PUB'
        tags:
          - 'M09: Search'
        requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  query:
                    type: string
                required:
                  - query
        responses:
          '302':
            description: 'Redirect after processing the query.'
            headers:
              Location:
                schema:
                  type: string
                examples:
                  302Success:
                    description: 'Successful search. Redirect to search results page.[UI05]'
                    value: '/search/{query}'
                  302Failure:
                    description: 'Failed search. Redirect to home page.'
                    value: '/'
          '400':
            description: 'Bad Request'

```

---


## A8: Vertical prototype

This artifact pertains to the vertical prototype of the project and it contains the list of implemented user stories and web resources.

### 1. Implemented Features

#### 1.1. Implemented User Stories


| User Story reference | Name                   | Priority                   | Description                   |
| -------------------- | ---------------------- | -------------------------- | ----------------------------- |
| US01     | View Top News Feed |High |at I can view all the most relevant news available. |
| US02 | View News Item | High | As a User, I want to access a single News Item so that I can read a more detailed version of it. |
| US03 | Search | High | As a User, I want to search for a specific tag, comment, or news item so that I can find that information quicker. |
| US04 | View News Item Comments | Medium | As a User, I want to view the comments of each news item, so that I can know detailed people's opinions about that news item.|
| US05 | View Other Users' Profiles | Medium | As a User, I want to view the profiles of other people, so that I can check their reputation, and news and comment history. |
| US10 | Sign-in | High | As a Visitor, I want to be able to authenticate so that I can have access to a lot of new features on the platform. |
| US11 | Sign-up | High | As a Visitor, I want to be able to create an account in the system so that I can authenticate and have my profile. |
| US13 | Create News Item | High | As an Authenticated User, I want to create and publish a news item, so that it becomes available to other users. |
| US14 | Sign-out | High | As an Authenticated User, I want to sign out from my account, so that I can end the login session. |
| US15 | Edit Profile | High | As an Authenticated User, I want to edit my profile so that I can keep my personal information updated. |
| US16 | View Personal Profile | High | As an Authenticated User, I want to view my user profile so that I can check my post and comment history, and personal information and have an option to edit it. |
| US17 | View User News Feed | High | As an Authenticated User, I want to view a custom news feed so that I can have access to all the news of the people and tags that I am following. |
| US29 | Edit News Item | Medium | As a News Author, I want to edit one of my published articles, so that I can correct/update said article. |
| US30 | Delete News Item | Medium | As a News Author, I want to remove one of my published articles, so that it disappears from the platform. |
| US36 | Administer User Accounts | High | As an Administrator, I want to search, view, edit and create user accounts so that I can manage them accordingly. |
| US38 | Manage User Accounts | Medium | As an Administrator, I want to manage user accounts so that the users have access to the platform only when they comply with the guidelines. | 
| US40 | Manage Content | Low | As an Administrator, I want to manage users' content so that no forbidden content is on the platform. |

#### 1.2. Implemented Web Resources


<b>Module M01: Authentication</b>b>

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R101: Login Form | /login |
| R102: Login Action | /login |
| R103: Logout Action | /logout |
| R104: Register Form | /register |
| R105: Register Action | /register |


<b>Module M02: Users</b>

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R201: Gets a profile page of a user | /profile/{id}|
| R202: Displays User edit page | /edit_profile/{id} |
| R203: Edits a user's profile | /api/edit_profile/{id} |
| R204: Changes a users admin role | /change_admin/{id} |


<b>Module M02: News</b>

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R301: Shows home feed | /news/{id} |
| R302: Shows news item | / |
| R303: News creation action | /api/news |
| R304: Deletes a news item | /api/news/{news_id} |
| R305: Edits a news item | /api/news/update/{news_id} |

<b>Module M08: Search</b>
| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R801: Search for news posts or users | /search |




### 2. Prototype

Prototype available at: https://lbaw2286.lbaw.fe.up.pt/
Prototype source code available at: https://git.fe.up.pt/lbaw/lbaw2223/lbaw2286/-/tree/EAP

Admin Credentials:
email: admin@example.com
password: 1234

---


## Revision history


***
lbaw2223-t8g6, 23/11/22
 
- André Morais, up202005303@edu.fe.up.pt (editor)
- João Teixeira, up202005437@edu.fe.up.pt
- Lucas Sousa, up202004682@edu.fe.up.pt
- Rui Soares, up202103631@edu.fe.up.pt



