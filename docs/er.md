# ER: Requirements Specification

The Super Legit Collaborative News (SLCN) is a project headed by a small group of developers with the main goal of free, open, and accessible news sharing for and by users.

This will allow all users to view and browse all types of news and comments on any topic, with access to text search and category selection.

# A1: Super Legit Collaborative News (SLCN)

The Super Legit Collaborative News (SLCN) is a project headed by a small group of developers with the main goal of free, open, and accessible news sharing for and by users.

This will allow all users to view and browse all types of news and comments on any topic, with access to text search and category selection.

On the home page, the users will view the trending or recent news items and be able to search by any news item, user or category on the search bar.

The users can register an account on the platform and be able to login as authenticated users. These users will be able to post news and comments, as well as vote on any of them. They will have access to a profile, housing their personal information, profile picture, and reputation. The reputation is determined by the number of likes and dislikes on their news and comments.

They will also be able to follow or unfollow other users and categories. By following another person, the news they publish will appear on the user's feed. 
The platform will also employ notifications to inform users of every like and comment made on their posts.

Besides the home page, authenticated users will also have access to a profile page. In their profile, the authors have access to a list of their posted news and comments, which they can edit and delete and have a place where they can manage the users they follow and the users following them. Also, they will have options to edit their own profile picture and other information.

The platform will also employ administrators capable of moderating, editing, and deleting posts, comments, and user accounts. Administrators will also be in charge of managing categories.

The platform will have an adaptive, responsive design to allow it to work smoothly on multiple devices (desktop, smartphone, etc.) as well as an intuitive user interface and navigation.

# A2: Actors and User stories

This artifact contains the information and specification of the actors and their user stories. It also contains the projects supplementary requirements.

## 1. Actors

The actors for the Super Legit Collaborative News (SLCN) project are represented in Figure 1 and described in Table 1.
<p  align="center">
    <img src="./pictures/actor_diagram.svg">
    <figcaption align = "center">Figure 1: SLCN actors</figcaption>
</p>
<br>

<p>

|Identifier| Description|
| --- | --- |
| User | Generic User that can view and search news items and comments |
| Visitor | Unauthenticated user that can sign-in or sign-up |
| Authenticated User| Authenticated user that can also make a new post, comment on a post, vote on a post or comment, has access to a profile, can follow and unfollow users and categories and has a reputation|
| News Author | Authenticated User that can also edit and delete their news posts|
| Comment Author | Authenticated User that can also edit and delete their comments |
| Administrator | Authenticated User that is responsible for the moderation of the users and their content. They can edit or delete posts and comments of any user, as well as their profiles and manage tags and categories|
<figcaption align = "center">Table 1: SLCN actors description</figcaption>
</p>

## 2. User Stories

For the SLCN project, the considered user stories are presented below.

<p>
<br>

### 2.1 User

|Identifier | Name| Priority|  Description|
| --- | --- | --- | --- |
| US01 | View Default Home Feed | High | As a User, I want to access the home page, so that I can view all the news and setting options available. |
| US02 | View News Item | High | As a User, I want to access a single News Item so that I can read a more detailed version with a description. |
| US03 | Sort home feed by popularity | High | As a User, I want to sort the news by popularity so that I can have access to the most relevant posts at the moment. |
| US04 | Search | High | As a User, I want to search for a specific category, comment or news item so that I can find that information quicker.  |
| US05 | Read Comment | Medium | As a User, I want to see the comments of each news item, so that I can read them. |
| US06 | Sort news feed by recent  | Medium | As a User, I want to sort the news by most recent so I can have access to the newest posts. |

<figcaption align = "center">Table 2: User's user stories</figcaption>

</p>
<p>
<br>

### 2.2 Visitor

|Identifier | Name| Priority|  Description|
| --- | --- | --- | --- |
| US07 | Sign-in | High | As a Visitor, I want to be able to authenticate so that I can interact with the news items. |
| US08 | Sign-up | High | As a Visitor, I want to be able to create an account in the system so that I can authenticate. |
| US09| Recover Password | Medium | As a Visitor, I want to be able to recover my password, so that I can access my account in case I have forgotten the password for it. |
<figcaption align = "center">Table 3: Visitor's user stories</figcaption>
</p>
<p>
<br>

### 2.3 Authenticated User

|Identifier | Name| Priority|  Description|
| --- | --- | --- | --- |
| US10 | View Custom Home Feed | Medium | As an Authenticated User, I want to view a custom home feed so that I can have access to all the news of the people and categories that I am following. 
| US10 | Create News Item | High | As an Authenticated User, I want to create and publish a news item, so that it becomes available to other users. |
| US11 | Logout | High | As an Authenticated User, I want to logout from my account, so that I can leave. |
| US12 | Edit Profile | High | As an Authenticated User, I want to edit my profile so that I can keep my personal information updated. |
| US13 | View Personal Profile | High | As an Authenticated User, I want to view my user profile so that I can check my personal information and have an option to edit it. |
| US14 | View other profiles | High | As an Authenticated User, I want to view the profiles of other people, so that I can check their post and comment history. |
| US15 | Create a Comment | Medium | As an Authenticated User, I want to create and publish a comment, so that it becomes available for other users to read. |
| US17 | Answer a Comment | Low | As an Authenticated User, I want to answer other people's comments so that I can comment on other people's point of view. |
| US16 | Vote on News Item | Medium | As an Authenticated User, I want to like or dislike a news item, so that I can declare my opinion on it. |
| US18 | Save News Item | Low | As an Authenticated User, I want to be able to save a news item so I can keep track of my favorite news. | 
| US17 | Remove Vote on News Item | Medium | As an Authenticated User, I want to remove my vote on a news item, so that it is removed from the platform. |
| US18 | Vote on Comment | Medium | As an Authenticated User, I want to like or dislike a comment, so that I can declare my opinion on it. |
| US19 | Remove Vote on Comment | Medium | As an Authenticated User, I want to remove my vote on a comment, so that it is removed from the platform. |
| US20 | Delete Account | Medium | As an Authenticated User, I want to be able to delete my account so that I can delete my personal data from the platform. |
| US | Report | Low | As an Authenticated User, I want to report to the administrator news items, users, or comments that are not respecting me or others. |
| US21 | Apply to an administrator account | Medium | As an Authenticated User, I want to apply for an Administrator Account so that I can become an administrator. |
| US22 | Follow categories | Medium | As an Authenticated User, I want to follow categories so I can choose to view the categories of my best interest. |
| US23 | Unfollow categories | Medium | As an Authenticated User, I want to unfollow categories so I can stop viewing categories I'm no longer interested in. |
| US24 | Follow other peoples profile | Medium | As an Authenticated User, I want to follow other people's profiles so that I can easily access their posts. |
| US25 | Unfollow other peoples profile | Medium | As an Authenticated User, I want to unfollow other people's profiles so that I can stop viewing news from people that I'm not interested in. |
| US24 | Profile Picture | Medium | As an Authenticated User, I want to edit my own profile picture so that others can see myself and my interests when visiting my profile or viewing my posts and comments. |
<figcaption align = "center">Table 4: Authenticated User's user stories</figcaption>
</p>
<p>
<br>

### 2.4 News Author

|Identifier | Name| Priority|  Description|
| --- | --- | --- | --- |
| US25 | Edit News Item | Medium | As a News Author, I want to edit one of my published articles, so that I can correct/update said article. |
| US26 | Delete News Item | Medium | As a News Author, I want to remove one of my published articles, so that it disappears from the platform. |
| US27 | News Vote Notification | Medium | As a News Author, I want to receive a notification whenever someone votes on a news item I posted, so that I'm aware of its popularity. |
| US28 | News Comment Notification | Medium | As a News Author, I want to receive a notification whenever someone comments on one of my news items, so that I can read it immediately. |
<figcaption align = "center">Table 5: News Author's user stories</figcaption>
</p>
<p>
<br>

### 2.5 Comment Author

|Identifier | Name| Priority|  Description|
| --- | --- | --- | --- |
| US29 | Edit Comment | Medium | As a Comment Author, I want to edit one of my published comments, so that I can correct/update said comment. |
| US30 | Remove Comment | Medium | As a Comment Author, I want to remove one of my published comments, so that it disappears from the platform. |
| US31 | Comment Vote Notification | Medium | As a Comment Author, I want to receive a notification whenever someone votes on a comment I posted, so that I'm aware of its popularity. |
<figcaption align = "center">Table 6: Comment Author's user stories</figcaption>

</p>
<p>
<br>

### 2.6 Administrator

|Identifier | Name| Priority|  Description|
| --- | --- | --- | --- |
| US33 | Administer User Accounts | High | As an Administrator, I want to search, view and edit user accounts so that I can manage them. |
| US34 | Manage categories | Medium | As an Administrator, I want to manage the category so that I can add or delete them. |
| US34 | Manage reports | Low | As an Administrator, I want to manage the reports sent by the users so that I can verify if the reports are really disrespecting the guidelines. |
| US35 | Manage categories Proposals | Low | As an Administrator, I want to manage category proposals so that I can accept or reject the categories proposed by other users. |
| US35 | Manage User Accounts | Medium | As an Administrator, I want to manage user accounts so that the users who break the community guidelines can't disturb the platform. | 
| US36 | Manage Admin appplications | Low | As an Administrator, I want to be able to accept or decline admin applications so that I can make sure the admins are a restrict group. |
| US37 | Delete User Account | Medium | As an Administrator, I want to delete user accounts in order to moderate the forums so that if the user in question disobeys the guidelines he can't disturb the forums anymore. |
<figcaption align = "center">Table 7: Administrators's user stories</figcaption>
</p>

## 3. Supplementary Requirements

This section contains the business rules, technical requirements and restrictions of the project.

<p>
<br>

### 3.1 Business Rules

</p>

|Identifier | Name| Description|
| --- | --- | --- |
| BR01 | User Reputation | User reputation should be derived from the number of likes and dislikes received by a user on their posts and comments. |
| BR02 | Deleting posts and comments | A post or comment cannot be deleted by its author if it has likes or comments. |
| BR03 | Account deletion | On account deletion, posts, likes, dislikes and comments should be kept in the platform but marked as anonymous. |
| BR04 | Category on posts | To post a news item, the author must select at least one category. |
| BR05 | Vote/comment on own items | A news item or comment author has the ability to vote and comment on their own items. |
<figcaption align = "center">Table 8: Business rules</figcaption>
<p>
<br>

### 3.2 Technical Requirements

</p>

|Identifer | Name| Description|
| --- | --- | --- |
| TR01 | Performance | The system should have response times shorter than 2s to ensure the user's attention.|
| TR02 | Robustness | The system must be prepared to handle and continue operating when runtime errors occur. |
| TR03 | Scalability | The system must be prepared to deal with the growth in the number of users and their actions. |
| TR04 | Accessibility | The system must ensure that everyone can access the pages, regardless of whether they have any handicap or not, or the Web browser they use. |
| **TR05** | **Usability** | **The system should be intuitive and easy to use.<br><br> Viewing the project as a collaborative news website, any user should be able to use it regardless of background or experience.** |
| **TR06** | **Database** | **The PostgreSQL database management system must be used.<br><br>Considering the news, user information, comments and votes that are integral to the website as well as their relations to each other, it is important to develop and utilize a robust and well thought out database to accommodate those needs.** |
| **TR07** | **Security** | **The system must protect the users information from unauthorised access as well as employ authentication and verification features. <br><br> Since we are working with a platform with user accounts we consider it is very important to keep the users personal data secure.** |
<figcaption align = "center">Table 9: Technical Requirements</figcaption>
<p>
<br>

### 3.3 Restrictions

| Identifier | Name | Description |
| --- | --- | --- |
| C01 | Deadine | The system should be ready by the week of 02/01/2023 to be submitted for evaluation. |
<figcaption align = "center">Table 10: Project Restrictions</figcaption>
</p>


# A3: Information Architecture

This artifact serves as an overview of the planned information architecture of the system.

## 1. Sitemap

Our system is built around 5 main areas. The Static Pages, which provide information about the platform. The News Pages, which envelop all the news items, news feeds and news item creations. The Visitor Pages, for logging in and signing up. The Authenticated User Pages, for the user profile, saved news and report user pages. And the Admin Pages, housing admin specific pages and utilities.

<p  align="center">
    <img src="./pictures/sitemap.png">
    <figcaption align = "center">Figure 2: Sitemap</figcaption>
</p>

## 2. Wireframes

Below are presented wireframes for the Homepage(UI01), News Item Details page(UI02) and User Profile Page(UI03).

<p  align="center">
    <img src="./pictures/ui01.png">
    <figcaption align = "center">Figure 3: Homepage(UI01) wireframe</figcaption>
</p>
<br>
<p  align="center">
    <img src="./pictures/ui02.png">
    <figcaption align = "center">Figure 4: News Item Details(UI02) wireframe</figcaption>
</p>
<br>
<p  align="center">
    <img src="./pictures/ui03.png">
    <figcaption align = "center">Figure 5: User Profile(UI03) wireframe</figcaption>
</p>

# Team

- André Morais, up202005303@edu.fe.up.pt
- João Teixeira, up202005437@edu.fe.up.pt
- Lucas Sousa, up202004682@edu.fe.up.pt
- Rui Soares, up202103631@edu.fe.up.pt

#### lbaw2223-t8g6, 27/09/22
