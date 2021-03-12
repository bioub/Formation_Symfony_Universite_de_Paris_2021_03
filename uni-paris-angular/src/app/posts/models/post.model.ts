import { User } from "src/app/core/models/user.model";

export class Post {
  id: string;
  user: User;
  title: string;
  created: string;
  content: string;
  comments: string[];
}

export class PostDto {
  title: string;
  content: string;
}
