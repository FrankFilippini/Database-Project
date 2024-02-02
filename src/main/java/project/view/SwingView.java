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
}
