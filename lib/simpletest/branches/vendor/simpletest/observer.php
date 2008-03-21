<?php
    if (!defined("SIMPLE_TEST")) {
        define("SIMPLE_TEST", "./");
    }
    
    /**
     *    Part of observer pattern. Interface for test issued
     *    events. Should also paint itself by accepting a
     *    visiting painter in subclasses.
     */
    class TestEvent {
        var $_label;
        
        /**
         *    Sets the event label.
         *    @param $label     Message to be carried by the event.
         */
        function TestEvent($label) {
            $this->_label = $label;
        }
        
        /**
         *    Accessor for the event message.
         *    @return     Event message.
         */
        function getLabel() {
            return $this->_label;
        }
        
        /**
         *    Abstract. Accepts visiting painter.
         *    @param $painter    TestReporter class to write to.
         */
        function paint(&$painter) {
        }
    }
    
    /**
     *    Generated by a test on either a pass or fail.
     *    Can use a visiting painter to display the
     *    correct result.
     */
    class TestResult extends TestEvent {
        var $_result;
        
        /**
         *    Stashes the result, true for a pass, and the test
         *    label.
         *    @param $result    True if passed.
         *    @param $label     Message to be carried by the event.
         */
        function TestResult($result, $label = "") {
            $this->TestEvent($label);
            $this->_result = $result;
        }
        
        /**
         *    Paints the approppriate result to the visting
         *    TestReporter.
         *    @param $painter    TestReporter class to write to.
         */
        function paint(&$painter) {
            if ($this->_result) {
                $painter->paintPass($this->getLabel());
            } else {
                $painter->paintFail($this->getLabel());
            }
        }
    }

    /**
     *    Issued at the start of a test. This allows the
     *    test painter to keep internal records of which
     *    tests are currently running, etc.
     */
    class TestStart extends TestEvent {

        /**
         *    Stashes the starting message, usually a test name.
         *    @param $label     Message to be carried by the event.
         */
        function TestStart($label) {
            $this->TestEvent($label);
        }
        
        /**
         *    Paints itself into the visiting painter.
         *    @param $painter    TestReporter class to write to.
         */
        function paint(&$painter) {
            $painter->paintStart($this->getLabel());
        }
    }

    /**
     *    Issued at the end of a test. This allows the
     *    test painter to keep internal records of which
     *    tests are currently running, etc.
     */
    class TestEnd extends TestEvent {
        
        /**
         *    Stashes the ending message, usually a test name.
         *    @param $label     Message to be carried by the event.
         */
        function TestEnd($label) {
            $this->TestEvent($label);
        }
        
        /**
         *    Paints itself into the visiting painter.
         *    @param $painter    TestReporter class to write to.
         */
        function paint(&$painter) {
            $painter->paintEnd($this->getLabel());
        }
    }

    /**
     *    Base class that can attach and notify observing
     *    objects.
     */
    class TestObservable {
        var $_observers;
        
        /**
         *    Starts with an empty list of observers.
         */
        function TestObservable() {
            $this->_observers = array();
        }
        
        /**
         *    Adds an object with a notify() method.
         *    @param $observer    Observer added to the internal list.
         */
        function attachObserver(&$observer) {
            $this->_observers[] = &$observer;
        }
        
        /**
         *    Passes the event object down to the notify()
         *    method of all of it's observers.
         *    @param $event        Event to pass on.
         */
        function notify(&$event) {
            for ($i = 0; $i < count($this->_observers); $i++) {
                $this->_observers[$i]->notify(&$event);
            }
        }
    }
    
    /**
     *    Interface definition for object that can be attached
     *    to the observer. Not used (for mocking only).
     */
    class TestObserver {
        
        /**
         *    Do nothing constructor.
         */
        function TestObserver() {
        }
        
        /**
         *    Does nothing with the incoming event. Abstract.
         *    @param $event    Event to acted upon.
         */
        function notify(&$event) {
        }
    }
    
    /**
     *    Can recieve test events and display them. Display
     *    is achieved by making display methods available
     *    and visiting the incoming event. Abstract.
     */
    class TestReporter extends TestObserver {
        
        /**
         *    Does nothing.
         */
        function TestReporter() {
            $this->TestObserver();
        }
        
        /**
         *    Handles the incoming event by invoking it's paint()
         *    method passing itself in as a visitor.
         *    @param $event        Event to show.
         */
        function notify(&$event) {
            $event->paint(&$this);
        }
        
        /**
         *    Paints the start of a test.
         *    @param $test_name        Name of test or other label.
         */
        function paintStart($test_name) {
        }
        
        /**
         *    Paints the end of a test.
         *    @param $test_name        Name of test or other label.
         */
        function paintEnd($test_name) {
        }
        
        /**
         *    Paints a pass. This will often output nothing.
         *    @param $message        Passing message.
         */
        function paintPass($message) {
        }
        
        /**
         *    Paints a failure.
         *    @param $message        Failure message from test.
         */
        function paintFail($message) {
        }
    }
?>