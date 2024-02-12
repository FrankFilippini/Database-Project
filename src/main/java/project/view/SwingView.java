package project.view;

import javax.swing.JFrame;

import project.core.Controller;

/**
 * Implementation of the View using JSwing for the GUI.
 */

public class SwingView implements View {
    private final Controller controller;
    private final JFrame frame = new JFrame();

    /**
     * Constructor for SwingView.
     * @param controller is the controller of the app
     */
    public SwingView(Controller controller) {
        this.controller = controller;
        this.frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
    }

    @Override
    public void start() {
        this.frame.setVisible(true);
    }

    @Override
    public void startConnection() {
        // TODO Auto-generated method stub
        throw new UnsupportedOperationException("Unimplemented method 'startConnection'");
    }
}
