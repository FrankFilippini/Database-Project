package project.query;

import java.util.List;

public class TableImpl implements Table{

    private List<List<String>> records;

    /**
     * Constructor
     * @param records given list of records
     */
    public TableImpl(List<List<String>> records) {
        this.records = records;
    }

    @Override
    public List<String> getColumnsName() {
        return this.records.get(0);
    }

    @Override
    public List<List<String>> getRecords() {
        return this.records;
    }

    @Override
    public List<String> getRecord(int index) {
        if (index < 1 || index >= records.size()) {
            throw new IndexOutOfBoundsException("Wrong Index!!!");
        }
        return this.records.get(index);
    }
    
}
