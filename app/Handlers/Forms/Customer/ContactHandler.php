<?php
namespace App\Handlers\Forms\Customer;


use App\Support\Facades\Message;
use App\Support\FormHandler;
use Illuminate\Support\Facades\Mail;

class ContactHandler extends FormHandler
{
    public function handle()
    {
        $request = $this->request->all();

        Mail::queue(
            'emails.contact',
            ['comment' => $request['comment']],
            function ($message) use ($request) {
                $message
                    ->to(config('mail.from.address'), config('mail.from.name'))
                    ->from($request['email'])
                    ->subject(trans('contactform.email.subject'));
            });

        Message::addSuccess(trans('contactform.success.message'));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Form\Customer\Contact',
            'App\Handlers\Forms\ContactFormHandler@handle'
        );
    }

}