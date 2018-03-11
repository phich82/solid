<?php

namespace App\Providers;

use App\Entities\Sms;
use App\Entities\Mail;
use App\Entities\Slack;
use App\Entities\Skype;
use App\Contracts\Notify;
use App\Entities\MailOnly;
use App\Entities\MailAndSms;
use App\Contracts\SmsAdapter;
use App\Entities\SmsDecorator;
use App\Contracts\MailAdapter;
use App\Contracts\SlackAdapter;
use App\Contracts\SkypeAdapter;
use App\Entities\TwitterClient;
use App\Entities\SlackDecorator;
use App\Entities\SkypeDecorator;
use App\Entities\FacebookClient;
use App\Entities\TwitterAdapter;
use App\Entities\MailAndSmsAndSlack;
use App\Contracts\SocialPostContract;
use Illuminate\Support\ServiceProvider;
use App\Contracts\SocialUpdateContract;

class NotifyServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MailAdapter::class, function ($app) {
           return new Mail;
        });

        $this->app->singleton(SmsAdapter::class, function ($app) {
           return new Sms;
        });

        $this->app->singleton(SlackAdapter::class, function ($app) {
           return new Slack;
        });

        $this->app->singleton(SkypeAdapter::class, function ($app) {
            return new Skype;
         });

        $this->app->singleton(Notify::class, function ($app) {
            /* ===== Repeat codes => violate DRY principle => solution: use Decorator pattern ===== */
            //return new MailOnly(new Mail); //only send email
            //return new MailAndSms(new Mail, new Sms); // send email & sms
            //return new MailAndSmsAndSlack(new Mail, new Sms, new Slack); // send email & sms & slack
        
            /* ===== Use Decorator pattern ===== */
            /* only use email */
            //return new MailOnly(new Mail);

            /* use email & sms */
            //return new SmsDecorator(
            //    new MailOnly(new Mail), 
            //    new Sms
            //);

            /* use email & sms & slack */
            //return new SlackDecorator(
            //    new SmsDecorator(new MailOnly(new Mail), new Sms), 
            //    new Slack
            //);

            /* use email & sms & slack & skype */
            return new SkypeDecorator(
                new SlackDecorator(new SmsDecorator(new MailOnly(new Mail), new Sms), new Slack),
                new Skype
            );
        });

        $this->app->singleton(SocialUpdateContract::class, function ($app) {     
            return new TwitterClient;
        });

        $this->app->singleton(SocialPostContract::class, function ($app) {
            //return new FacebookClient; /* post from Facebook */
            return new TwitterAdapter(new TwitterClient); /* post from Twitter */
        });
    }
}
