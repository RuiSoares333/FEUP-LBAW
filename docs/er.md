# ER: Requirements Specification

The Super Legit Collaborative News (SLCN) is a project headed by a small group of developers with the main goal of free, open and accessible news sharing for and by users. 

This will allow all users to view and browse the top and most recent news and comments on any topic, with access to text search and category filtering.


# A1: Super Legit Collaborative News (SLCN)

The Super Legit Collaborative News (SLCN) is a project headed by a small group of developers with the main goal of free, open and accessible news sharing for and by users. 

This will allow all users to view and browse the top and most recent news and comments on any topic, with access to text search and category filtering.

On top of that, authenticated users will be able to post news and comments of their own, aswell as vote on any of them.
They will have access to a profile, housing their information, profile picture and reputation. Here will also be a list of posted news and comments, which can be edited and deleted by the author. 
They also will be able to follow other users, specific tags and categories and view their favorite items.
Their reputation will be determined by the number of likes and dislikes on their posts and comments.
The plataform will employ notifications to inform users of every like and comment on a post.

The platform will also employ administrators capable of moderating, editing and deleting posts, comments and user profiles and will be in charge of managing tags and categories.

The platform will have adaptive, responsive design to allow usage on multiple devices (desktop, smartphone, etc) aswell as an intuitive user interface and navigation.

# A2: Actors and User stories
This artifact contains the information and specification of the actors and their user stories.

## 1. Actors
The actors for the Super Legit Collaborative News (SLCN) project are represented in Figure 1 and described in Table 1.
<p  align="center">
    <img src="./pictures/actor_diagram.png">
    <figcaption align = "center">Figure 1: SLCN actors</figcaption>
</p>
<br>

<p>

|Identifier| Description|
| --- | --- |
| User | Generic User that can view and search news items and comments |
| Guest | Unauthenticated user that can sign-in or sign-up |
| Standard User| Authenticated user that can also make a new post, comment on a post, vote on a post or comment, has access to a profile, can follow and unfollow users and categories and has a reputation|
| News Author | Authenticated standard user that can also edit and delete their news posts|
| Comment Author | Authenticated standard user that can also edit and delete their comments |
| Administrator | Authenticated user that is responsible for the moderation of the users and their content. They can edit or delete posts and comments of any user, aswell as their profiles and manage tags and categories|
<figcaption align = "center">Table 1: SLCN actors description</figcaption>
</p>

## 2. User Stories
For the SLCN project, the considered user stories are presented below.

<p>
<br>

### 2.1 User
|Identifier | Name| Priority|  Description|
| --- | --- | --- | --- |
| US01 | See Home Feed | High | As a user I want to access the home page, so that I can see all the news and options available. |
| US02 | Read Comment | Medium | As a User, I want to see the comments of each news item, so that I can read them. |
| US03 | View News Item | High | As a User I want to access a single News Item and read a more detailed version. | 
| US04 | Search | Medium | As a User I want to the search for a specific category, commentary or news item so that I can find that information quicker.  | 
| US05 | Sort news feed by recent  | Medium | As a User I want to sort the news by most recent so I can have access to the newest topics. |
| US06 | Sort home feed by popularity | High | As a User I want to sort the news by popularity so that I can have access to the most relevant topics at the moment. |

</p>
<p>
<br>

### 2.2 Guest
|Identifier | Name| Priority|  Description|
| --- | --- | --- | --- |
| USXX | Sign-in | High | As a Guest, I want to be able to authenticate so that I can interact with the news items. |
| USXX | Sign-up | High | As a Guest, I want to be able to create an account in the system so that I can authenticate. |
| USXX| Recover Password | Medium | As a Guest, I want to recover my password in the case I forgot it. | 

</p>
<p>
<br>

### 2.3 Standard User
|Identifier | Name| Priority|  Description|
| --- | --- | --- | --- |
| USXX | Create News Item | High | As a Standard User, I want to create and publish a news item, so that it becomes available to other users. |
| USXX | Create a Comment | Medium | As a Standard User, I want to create and publish a comment, so that it becomes available for other users to read. | 
| USXX | Vote on News Item | Medium | As a Standard User, I want to like or dislike a news item, so that I can declare my opinion on it. | 
| USXX | Remove Vote on News Item | Medium | As a Standard User, I want to remove my vote on a news item, so that it is removed from the platform. | 
| USXX | Vote on Comment | Medium | As a Standard User, I want to like or dislike a comment, so that I can declare my opinion on it. | 
| USXX | Remove Vote on Comment | Medium | As a Standard User, I want to remove my vote on a comment, so that it is removed from the platform. | 
| USXX | Delete Account | Medium | As a Standard User, I want to Delete my own account. | 
| USXX | Administrator Accounts | Medium | As an Administrator, I want to apply for an Administrator, Account. |
| USXX | Logout | High | As a Standard User, I want to logout from my account, so that I can leave. | 
| USXX | Edit Profile | High | As a Standard User, I want to edit my profile so that I can keep my personal information updated. | 
| USXX | View Profile | High | As a Standard User, I want to View user profiles so that I can check my own personal information and that of other Users. |
| USXX | Follow other peoples profile | High | As a Standard User, I want to follow other peoples profile so that I can easily access their posts. |
| USXX | Unfollow other peoples profile | High | As a Standard User, I want to unfollow other peoples profile so that I can stop seeing news from people that I don't like. |

</p>
<p>
<br>

### 2.4 News Author
|Identifier | Name| Priority|  Description|
| --- | --- | --- | --- |
| USXX | Edit News Item | High | As a News Author, I want to edit one of my published articles, so that I can correct/update said article. |
| USXX | Remove News Item | High | As a News Author, I want to remove one of my published articles, so that it disappears from the platform. |
| USXX | News Vote Notification | Medium | As a News Author, I want to receive a notification whenever someone votes on a news item I posted, so that I'm aware of its popularity. |
| USXX | News Comment Notification | Medium | As a News Author, I want to receive a notification whenever someone comments on one of my news items, so that I can read it immediately. |

</p>
<p>
<br>

### 2.5 Comment Author
|Identifier | Name| Priority|  Description|
| --- | --- | --- | --- |
| USXX | Edit Comment | Medium | As a Comment Author, I want to edit one of my published comments, so that I can correct/update said comment. |
| USXX | Remove Comment | Medium | As a Comment Author, I want to remove one of my published comments, so that it disappears from the platform. |
| USXX | Comment Vote Notification | Medium | As a Comment Author, I want to receive a notification whenever someone votes on a comment I posted, so that I'm aware of its popularity. |
| USXX | News Comment Notification | Low | As a News Author, I want to receive a notification whenever someone comments on one of my comments, so that I can read it immediately. |


</p>
<p>
<br>

### 2.6 Administrator
|Identifier | Name| Priority|  Description|
| --- | --- | --- | --- |
| USXX | Manage Topic Proposals | Medium | As an Administrator, I want to manage the topic proposals in order to Add/Delete them [topics]. |
| USXX | Administer User Accounts | High | As an Administrator, I want to search, view, edit and create user Accounts. |
| USXX| Block and Unblock User Accounts | Medium | As an Administrator, I want to block and unblock user Accounts. |
| USXX | Delete User Account | Medium | As an Administrator, I want to Delete user accounts in order to moderate the forums if the user in question disobeys the website User Guidelines.  |
</p>

## 3. Supplementary Requirements
description

<p>

### 3.1 Business Rules
</p>

<p>

### 3.2 Technical Requirements
</p>
<p>

### 3.3 Restrictions
</p>