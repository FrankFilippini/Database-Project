package project.view;

import project.core.Controller;

/**
 * Implementation of the View using JSwing for the GUI.
 */

public class SwingView implements View {
    private final Controller controller;

    /**
     * Constructor for SwingView.
     * @param controller is the controller of the app
     */
    public SwingView(Controller controller) {
        this.controller = controller;
    }

    @Override
    public void start() {
        // TODO Auto-generated method stub
        throw new UnsupportedOperationException("Unimplemented method 'start'");
    }

    @Override
    public void startConnection() {
        // TODO Auto-generated method stub
        throw new UnsupportedOperationException("Unimplemented method 'startConnection'");
    }
}
