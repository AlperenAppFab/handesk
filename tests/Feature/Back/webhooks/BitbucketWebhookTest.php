<?php

namespace Tests\Feature;

use App\Authenticatable\Admin;
use App\Services\FakeIssueCreator;
use App\Services\IssueCreator;
use App\Ticket;
use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BitbucketWebhookTest extends TestCase
{
    use RefreshDatabase;
    use InteractsWithExceptionHandling;

    /** @test */
    public function can_receive_webhook()
    {
        $payload = json_decode('{
   "comment":{
      "links":{
         "self":{
            "href":"https://api.bitbucket.org/2.0/repositories/revo-pos/revo-app/issues/929/comments/40899645"
         },
         "html":{
            "href":"https://bitbucket.org/revo-pos/revo-app/issues/929#comment-40899645"
         }
      },
      "content":{

      },
      "created_on":"2017-10-30T18:36:57.848289+00:00",
      "user":{
         "username":"BadChoice",
         "type":"user",
         "display_name":"Jordi Puigdellivol",
         "uuid":"{4f024e7b-f697-4151-81e0-1a5178f8c6d4}",
         "links":{
            "self":{
               "href":"https://api.bitbucket.org/2.0/users/BadChoice"
            },
            "html":{
               "href":"https://bitbucket.org/BadChoice/"
            },
            "avatar":{
               "href":"https://bitbucket.org/account/BadChoice/avatar/32/"
            }
         }
      },
      "updated_on":null,
      "type":"issue_comment",
      "id":40899645
   },
   "changes":{
      "status":{
         "new":"open",
         "old":"new"
      }
   },
   "issue":{
      "content":{
         "raw":"Falta concretar",
         "markup":"markdown",
         "html":"<p>Falta concretar</p>"
      },
      "kind":"enhancement",
      "repository":{
         "full_name":"revo-pos/revo-app",
         "type":"repository",
         "name":"revo-app",
         "links":{
            "self":{
               "href":"https://api.bitbucket.org/2.0/repositories/revo-pos/revo-app"
            },
            "html":{
               "href":"https://bitbucket.org/revo-pos/revo-app"
            },
            "avatar":{
               "href":"https://bitbucket.org/revo-pos/revo-app/avatar/32/"
            }
         },
         "uuid":"{2d83eefb-f6b3-4d4f-a2cf-44aecfb04005}"
      },
      "links":{
         "attachments":{
            "href":"https://api.bitbucket.org/2.0/repositories/revo-pos/revo-app/issues/929/attachments"
         },
         "self":{
            "href":"https://api.bitbucket.org/2.0/repositories/revo-pos/revo-app/issues/929"
         },
         "watch":{
            "href":"https://api.bitbucket.org/2.0/repositories/revo-pos/revo-app/issues/929/watch"
         },
         "comments":{
            "href":"https://api.bitbucket.org/2.0/repositories/revo-pos/revo-app/issues/929/comments"
         },
         "html":{
            "href":"https://bitbucket.org/revo-pos/revo-app/issues/929/promos-autom-tiques"
         },
         "vote":{
            "href":"https://api.bitbucket.org/2.0/repositories/revo-pos/revo-app/issues/929/vote"
         }
      },
      "title":"Promos autom\u00e0tiques",
      "reporter":{
         "username":"BadChoice",
         "type":"user",
         "display_name":"Jordi Puigdellivol",
         "uuid":"{4f024e7b-f697-4151-81e0-1a5178f8c6d4}",
         "links":{
            "self":{
               "href":"https://api.bitbucket.org/2.0/users/BadChoice"
            },
            "html":{
               "href":"https://bitbucket.org/BadChoice/"
            },
            "avatar":{
               "href":"https://bitbucket.org/account/BadChoice/avatar/32/"
            }
         }
      },
      "component":null,
      "votes":0,
      "watches":1,
      "priority":"major",
      "assignee":null,
      "state":"open",
      "version":{
         "name":"2.0",
         "links":{
            "self":{
               "href":"https://api.bitbucket.org/2.0/repositories/revo-pos/revo-app/versions/222766"
            }
         }
      },
      "edited_on":null,
      "created_on":"2017-09-14T11:09:49.630392+00:00",
      "milestone":null,
      "updated_on":"2017-10-30T18:36:57.825625+00:00",
      "type":"issue",
      "id":929
   },
   "actor":{
      "username":"BadChoice",
      "type":"user",
      "display_name":"Jordi Puigdellivol",
      "uuid":"{4f024e7b-f697-4151-81e0-1a5178f8c6d4}",
      "links":{
         "self":{
            "href":"https://api.bitbucket.org/2.0/users/BadChoice"
         },
         "html":{
            "href":"https://bitbucket.org/BadChoice/"
         },
         "avatar":{
            "href":"https://bitbucket.org/account/BadChoice/avatar/32/"
         }
      }
   },
   "repository":{
      "scm":"git",
      "website":"http://www.revo.works/",
      "name":"revo-app",
      "links":{
         "self":{
            "href":"https://api.bitbucket.org/2.0/repositories/revo-pos/revo-app"
         },
         "html":{
            "href":"https://bitbucket.org/revo-pos/revo-app"
         },
         "avatar":{
            "href":"https://bitbucket.org/revo-pos/revo-app/avatar/32/"
         }
      },
      "project":{
         "links":{
            "self":{
               "href":"https://api.bitbucket.org/2.0/teams/revo-pos/projects/XEF"
            },
            "html":{
               "href":"https://bitbucket.org/account/user/revo-pos/projects/XEF"
            },
            "avatar":{
               "href":"https://bitbucket.org/account/user/revo-pos/projects/XEF/avatar/32"
            }
         },
         "type":"project",
         "uuid":"{4240b083-ceac-4940-9ecc-9d2b903017bc}",
         "key":"XEF",
         "name":"RevoXef"
      },
      "full_name":"revo-pos/revo-app",
      "owner":{
         "username":"revo-pos",
         "type":"team",
         "display_name":"Revo",
         "uuid":"{6fa4ada1-2d50-4aaf-94bc-5fffb9d4504f}",
         "links":{
            "self":{
               "href":"https://api.bitbucket.org/2.0/teams/revo-pos"
            },
            "html":{
               "href":"https://bitbucket.org/revo-pos/"
            },
            "avatar":{
               "href":"https://bitbucket.org/account/revo-pos/avatar/32/"
            }
         }
      },
      "type":"repository",
      "is_private":true,
      "uuid":"{2d83eefb-f6b3-4d4f-a2cf-44aecfb04005}"
   }
}', true);

        $this->actingAs(factory(Admin::class)->create());
        $ticket = factory(Ticket::class)->create();
        $ticket->createIssue(new FakeIssueCreator(929), "revo-app");

        $response = $this->post('webhook', $payload);
        $response->assertStatus(Response::HTTP_OK);
    }
}
